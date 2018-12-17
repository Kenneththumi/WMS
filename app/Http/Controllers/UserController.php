<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User as UserAlias;

use Illuminate\Support\Facades\File;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserAlias::where('role','>','0')->simplePaginate(5);

        $this->getRole($users);


        
        return view('records.writers', compact('users'));
    }

    public function getRole($users){

        foreach ($users as $user){
            $this->role($user);
        }

        return $users;

    }

    public function role($user){
        if($user->role == 3){
            $user->role = 'Super Admin';
        }elseif ($user->role == 2){
            $user->role = 'Admin';
        }elseif($user->role == 1){
            $user->role = 'Normal User';
        }

        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->proficiencies)){
            return back()->withErrors(['proficiencies'=>' Select disciplines you are proficient in.']);
        }

        $image ='';
        //validate input
        $this->validate($request, [
            'fname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'lname' => 'required|string|max:255',
            'tel' => 'required',
            'city' => 'required',
            'previous_work' => 'required',
            'availability' => 'required',
            'citations' => 'required',
            'highest_qualification' => 'required',
            'proficiencies' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if(!empty($request->file('image'))){
            $image = time().$request->image->getClientOriginalName();

            $request->image->move(public_path('profileImgs'),$image);
        }

        $user = new UserAlias();
            $user->fname = $request->fname;
            $user->email = $request->email;
            $user->lname = $request->lname;
            $user->role= 0;
            $user->account= 1;
            $user->tel = $request->tel;
            $user->image_path = $image;
            $user->passport = $request->passport;
            $user->password= bcrypt($request->password);
        $user->save();



        $user->moreinfo()->create([
            'tel2' => $request->tel2,
            'city' => $request->city,
            'previous_work' => $request->previous_work,
            'previous_work_timeline' => empty($request->previous_work_timeline)?'Not Given':$request->previous_work_timeline,
            'availability' => $request->availability,
            'urgent_work' => empty($request->urgent_work)?'No':$request->urgent_work,
            'citations' => implode(",",$request->citations),
            'highest_qualification' => $request->highest_qualification,
            'proficiencies' => implode(",", $request->proficiencies),
            'relevant_info'=>$request->relevant_info,
        ]);


        return redirect()
                ->route('login')
                ->with('message','Dear writer, Wait for account activation email.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = UserAlias::findOrFail($id);

        $this->role($user);

        $this->profPic($user);

       return view('others.profile', compact('user','citations','proficiencies'));
    }

    public function profPic($user){
        if(empty($user->image_path)){
            $user->image_path = 'img_placeholder.png';
        }

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = UserAlias::findOrFail($id);

        return view('form.editUser',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image ='';
        //validate input
        $this->validate($request, [
            'fname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'lname' => 'required|string|max:255',
            'role' => 'required',
            'tel' => 'required|string',
            'yob' => 'required|numeric',
            'passport' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if(!empty($request->file('image'))){
            $image = time().$request->image->getClientOriginalName();

            $request->image->move(public_path('profileImgs'),$image);
        }


        /** @var TYPE_NAME $image */
        UserAlias::findOrFail($id)->update([
            'fname' => $request->fname,
            'email' => $request->email,
            'lname' => $request->lname,
            'role' => $request->role,
            'age' => $request->yob,
            'tel' => $request->tel,
             empty($image)?:'image_path' =>$image,
            'passport' => $request->passport,
            'password' => bcrypt($request->password),
        ]);

        return redirect()
            ->route('getWriter',$id)
            ->with('message','Writer\'s profile has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = UserAlias::findOrFail($id);
        //delete prof pic

        if($user->orders()->where('status','current')->orWhere('status','revision')->count() > 0){
            return back()
                ->withErrors($user->fname.' '.$user->lname.' cannot be deleted: Has current/ revision orders.');
        }
        if($user->orders()->exists()){
            $user->orders()->delete();
        }
        if($user->moreinfo()->exists()){
            $user->moreinfo()->delete();
        }
        if($user->rating()->exists()){
            $user->rating()->delete();
        }

        $this->profPicDel($user);

        $user->delete();

        return redirect('/writers')
                ->with('message','Item deleted');
    }
    /**
     * delete selected  resource(s) in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){

        if(empty($request->chk)){
            return back()->withErrors('No selection was made');
        }

        $items = count($request->chk);

        for($i = 0;$i<$items; $i++){
            $id = $request->chk[$i];

            $user = UserAlias::findOrFail($id);

            if($user->orders()->where('status','current')->orWhere('status','revision')->count() > 0){
                return back()
                    ->withErrors($user->fname.' '.$user->lname.' cannot be deleted: Has current/ revision orders.');
            }
            if($user->orders()->exists()){
                $user->orders()->delete();
            }
            if($user->moreinfo()->exists()){
                $user->moreinfo()->delete();
            }
            if($user->rating()->exists()){
                $user->rating()->delete();
            }

            $this->profPicDel($user);

            $user->delete();
        }


        return back()
            ->with('message','Item(s) deleted');
    }


    public  function profPicDel($user){
        //get prof pic path
        $img = $user->image_path;

        $image_path = 'profileImgs'.DIRECTORY_SEPARATOR.$img;

        //delete prof image before actual delete
        if(File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }

        return $user;
    }

/*getNewWriters*/
    public function getNewWriters(){
        $users = UserAlias::where('role',0)->where('account',1)->simplePaginate(5);

        $this->getRole($users);



        return view('records.newWriters', compact('users'));
    }
    /*getNewWriters*/
    public function getBlockedWriters(){
        $users = UserAlias::where('role',0)->Where('account',0)->simplePaginate(5);

        $this->getRole($users);



        return view('records.blockedWriters', compact('users'));
    }
    /*activate writers*/
    public function activateWriter($id){
        $user = UserAlias::findOrFail($id);

        $user->update(['role'=>'1', 'account'=>'1']);

        /*Email notification to writer*/

        return redirect()
                    ->route('writers')
                    ->with('message',' User account activated. Email notification done.');
    }
    /*activate writers*/
    public function deactivateWriter($id){
        $user = UserAlias::findOrFail($id);

        $user->update(['role'=>'0', 'account'=>'0']);

        /*Email notification to writer*/

        return redirect()
            ->route('blocked')
            ->with('message',' User account deactivated.');
    }
    /*check if writer has orders*/
    public function hasOrders($id){

    }
}
