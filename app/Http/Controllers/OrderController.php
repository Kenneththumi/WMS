<?php

namespace App\Http\Controllers;


use App\Order;

use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('account');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()){
            $orders = Order::paginate(6);
            return view('records.orders',compact('orders'));
        }else{
            $orders = Order::where('user_id',auth()->user()->id)->paginate(6);
            return view('records.writer.myorders',compact('orders'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders = Order::All();

        if($orders->count() == 0){
            $id = 1;
        }else{
            $id = $orders->last()->id + 1;
        }

        $order_id='order-'.$id;

        //dd($orders->paperType);
        $order = new Order;

        $proficiencies = new User();
        $proficiencies =$proficiencies->proficiencies;


        return view('form.addOrder', compact('order_id', 'order','proficiencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate input
        $this->validate($request, [
            'order' => 'required|unique:orders,order_id',
            'due_date' => 'required|date|after_or_equal:today',
            'discipline' => 'required',
            'topic' => 'required',
            'sources' => 'required|numeric|min:0',
            'style' => 'required',
            'writing_type' =>'required',
            'paper_type'=>'required',
            'level'=>'required',
            'pages' => 'required|numeric|min:0',
            //'words' => 'required|numeric|min:0',
            //'amount' => 'required|numeric|min:0',
            'file' => 'mimes:jpeg,png,jpg,gif,doc,pdf,ppt,txt,pptx,docx,xslx,csv|max:2048',
        ]);

        /*if(substr($request->file->getClientOriginalName(), strripos($request->file->getClientOriginalName(), '.')+1) !=  ){

        }*/

        $order = new Order();


        //initialize file as empty variable
        $path = '';
        if(!empty($request->file('file'))){
            $path = time().$request->file->getClientOriginalName();

            $request->file->move(public_path('uploads'.DIRECTORY_SEPARATOR.'admin'),$path);
        }


        $order->create([
            'order_id' => $request->order,
            'due_date' => strtotime($request->due_date),
            'discipline' => $request->discipline,
            'topic' => $request->topic,
            'sources' => $request->sources,
            'style' => $request->style,
            'pages' => $request->pages,
            'writing_type' =>$request->writing_type,
            'paper_type'=>$request->paper_type,
            'level'=>$request->level,
            'status'=>'available',
            'user_id'=>0,
            'words' => $request->pages * 275,//one page is 275 words
            'instructions' => $request->instructions,
            'amount' => $request->pages * 2.5, //presuming on page is $2.5
        ]);
        $ordr = Order::where('order_id',$request->order)->firstOrFail();

        //save the file related
        $ordr->files()->create(['link' => empty($request->link)?'':$request->link,'file_path'=>$path]);


        return redirect()
                        ->route('orders')
                        ->with('message','Order successfully added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        //path to uploaded file
        $file_path = empty($order->files->first()->file_path)?'#':'uploads'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.$order->files->first()->file_path;
        //extenal link to cloud (e.g google drive or dropbox)
        $link = empty($order->files->first()->link)?'#':$order->files->first()->link;

        return view('others.order',compact('order','file_path','link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        //if external link exists for this model
        $link=$order->files()->exists()? $order->files->first()->link : '';

        $proficiencies = new User();
        $proficiencies =$proficiencies->proficiencies;


        return view('form.editOrder', compact('order','link','proficiencies'));
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
        //validate input
        $this->validate($request, [
            'due_date' => 'required|date|after_or_equal:today',
            'discipline' => 'required',
            'topic' => 'required',
            'sources' => 'required|numeric|min:0',
            'style' => 'required',
            'writing_type' =>'required',
            'paper_type'=>'required',
            'level'=>'required',
            'pages' => 'required|numeric|min:0',
            /*'words' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',*/
            'file' => 'mimes:jpeg,png,jpg,gif,doc,pdf,ppt,pptx,txt,docx,xslx,csv|max:2048',
        ]);

        $order = Order::findOrFail($id);


        //initialize file as empty variable
        $path = '';
        if(!empty($request->file('file'))){
            $path = time().$request->file->getClientOriginalName();

            //delete existing file if any
            $this->fileAdminDel($order);
            //move file
            $request->file->move(public_path('uploads'.DIRECTORY_SEPARATOR.'admin'),$path);
        }


        $order->update([
            'due_date' => strtotime($request->due_date),
            'discipline' => $request->discipline,
            'topic' => $request->topic,
            'sources' => $request->sources,
            'style' => $request->style,
            'pages' => $request->pages,
            'writing_type' =>$request->writing_type,
            'paper_type'=>$request->paper_type,
            'level'=>$request->level,
            'instructions' => $request->instructions,
            'words' => $request->pages * 275,//one page is 275 words
            'amount' => $request->pages * 2.5, //presuming one page is $2.5
        ]);

        if($order->files()->exists()){
            if(empty($path)){

                $order->files()->update(['link' => empty($request->link)?'':$request->link]);

            }else{
                $order->files()->update(['link' => empty($request->link)?'':$request->link, 'file_path'=>$path]);
            }
        }else{
            $order->files()->updateOrCreate(['link' => empty($request->link)?'':$request->link, 'file_path'=>$path]);
        }





        return redirect()
            ->route('getOrder',$id)
            ->with('message','Order successfully Updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $order = Order::findOrFail($id);
        if($order->deletable()){
            $this->fileAdminDel($order);

            if($order->files()->exists()){
                $order->files()->delete();
            }

            if($order->filewriter()->exists()){
                $order->filewriter()->delete();
            }

            if($order->applications()->exists()){
                $order->applications()->delete();
            }

            if($order->messages()->exists()){
                $order->messages()->delete();
            }

            $order->delete();

            return 'ok';
        }else{
            //if not
            return 'error';
        }




        /*return redirect('/orders')
            ->with('message', 'Item deleted');*/
    }


    /**
     * delete selected  resource(s) in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteOrders(Request $request)
    {

        if (empty($request->chk)) {
            return back()->withErrors('No selection was made');
        }

        $items = count($request->chk);

        for ($i = 0; $i < $items; $i++) {
            $id = $request->chk[$i];

            $response = $this->destroy($id);

            if($response == 'error'){
                return back()
                    ->withErrors(' Order-'.Order::findOrFail($id)->id.' cannot be deleted - status: '.Order::findOrFail($id)->status);
            }

        }


        return redirect('/orders')
            ->with('message', 'Item(s) deleted');

    }
//delete order

    public function fileAdminDel($order){

        if($order->files()->exists()){
                //get file path
                $path = $order->files->first()->file_path;

                $path = 'uploads'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.$path;

                //delete file before actual delete
                if(File::exists(public_path($path))) {
                    File::delete(public_path($path));
                }
                //delete record
                $order->files()->delete();
        }

        return $order;
    }
    //allocate order
    public function  allocate($id){
        $ordr = Order::findOrFail($id);
        $orders = $ordr->applications()->get();

        //create a new User instance to aid you in getting names & ratings inside blade
        $user = new User();

        return view('form.modalAllocation', compact('orders','ordr','user'));
    }

    public  function allocateOrder(Request $request,$id){
        //validate when no selection
        if(!$request->writer){
            return back()
                        ->withErrors('No selection made.');
        }

        Order::findOrFail($id)->update(
            ['user_id'=>$request->writer, 'status'=>'current']
        );

       return redirect()
                        ->route('orders')
                        ->with('message','Order allocated');

    }

//get list of available orders
    public function getAvailableOrders(){
        if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()) {
            $orders = Order::where('status', 'available')->paginate(6);

            return view('records.available', compact('orders'));
        }else{
            $orders = Order::where('status', 'available')->paginate(6);
            return view('records.writer.available',compact('orders'));
        }
    }

    public function getCurrentOrders(){
        if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()) {
            $orders = Order::where('status', 'current')->paginate(6);
            return view('records.current', compact('orders'));
        }else{
            $orders = Order::where('status', 'current')->where('user_id',auth()->user()->id)->paginate(6);
            return view('records.writer.current',compact('orders'));
        }

    }

    public function a_feedback(){
        if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()) {
            $orders = Order::where('status', 'a_feedback')->paginate(6);
            return view('records.awaitingFeedback', compact('orders'));
        }else{
            $orders = Order::where('status', 'a_feedback')->where('user_id',auth()->user()->id)->paginate(6);
            return view('records.writer.awaitingFeedback', compact('orders'));
        }
    }
    //feed back form
    public function moreFeedback($id){
        $order = Order::findOrfail($id);

        return view('form.moreFeedback', compact('order'));
    }
    //store the feedback
    public function addFeedback(Request $request, $id){
        //validate input
        $this->validate($request, [
            'state' => 'required',
        ]);

        $order = Order::findOrFail($id);

        $order->update(['status'=>$request->state]);
        if(!empty($request->message)){
            $order->messages()->create(['message'=>$request->message]);
        }


        if($order->filewriter()->exists()){
            //Remove file associated, uploaded by the writer, with the order
            $this->fileWriterDel($order);
            //Remove file records
            $order->filewriter()->delete();
        }

        if($request->state == 'completed' || $request->state == 'cancelled'){

            return view('form.ratings', compact('order'));
        }


        return redirect()
                        ->route('orders');

    }

    //adding writers ratings
    public function addRating(Request $request,$id){
        //validate input
        $this->validate($request, [
            'grammar' => 'required|numeric|min:0|max:100',
            'instructions' => 'required|numeric|min:0|max:100',
            'speed' => 'required|numeric|min:0|max:100',
        ]);

            $order = Order::findOrFail($id);

           $user_id = $order->user_id;

           $user = User::findOrFail($user_id);

           $ratings = $user->rating()->exists();
           if($ratings){
               $rating = $user->rating()->first();
               $rating->grammar += $request->grammar;
               $rating->instructions +=  $request->instructions;
               $rating->speed += $request->speed;
               $rating->originality += $request->originality;
               $rating->total += 1;
               $rating->completed +=1;
               $order->status =='completed'? $rating->completed +=1:' ';
               $rating->save();
           }else{
               if($order->status == 'completed'){
                   $user->rating()
                       ->create(['grammar'=>$request->grammar, 'instructions'=>$request->instructions, 'speed'=>$request->speed
                           ,'originality'=>$request->originality, 'total'=>1,'completed'=>1]);
               }elseif($order->status == 'cancelled'){
                   $user->rating()
                       ->create(['grammar'=>$request->grammar, 'instructions'=>$request->instructions, 'speed'=>$request->speed
                           ,'originality'=>$request->originality, 'total'=>1]);
               }
           }

        //record ratings for the order
           $order->orderratings()->updateOrCreate(['grammar'=>$request->grammar, 'instructions'=>$request->instructions, 'speed'=>$request->speed
               ,'originality'=>$request->originality]);

        return redirect()
            ->route('orders')
            ->with('message',' Ratings recorded.');
    }

    // get cancelled orders
    public function getCancelledOrders(){
        if( auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() ){
            $orders = Order::where('status','cancelled')->paginate(6);

            return view('records.cancelled', compact('orders'));
        }else{
            $orders = Order::where('status','cancelled')->where('user_id',auth()->user()->id)->paginate(6);

            return view('records.writer.cancelled', compact('orders'));
        }

    }
    // get accepted orders
    public function getAcceptedOrders(){
        if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()){
            $orders = Order::where('status','completed')->paginate(6);

            return view('records.accepted', compact('orders'));
        }else{
            $orders = Order::where('status','completed')->where('user_id',auth()->user()->id)->paginate(6);

            return view('records.writer.accepted', compact('orders'));
        }

    }
    // get revisionOrders
    public function getRevisionOrders(){
        if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()){
            $orders = Order::where('status','revision')->paginate(6);

            return view('records.revision', compact('orders'));
        }else{
            $orders = Order::where('status','revision')->where('user_id',auth()->user()->id)->paginate(6);

            return view('records.writer.revision', compact('orders'));
        }

    }

    //order application
    public function applyOrder($id){
        $order = Order::findOrFail($id);

        if($order->applications()->where('user_id',auth()->user()->id)->exists()){
            return back()
                        ->withErrors(' Already applied for the order.');
        }

        $order->applications()->create(['user_id'=>auth()->user()->id]);

        return back()
                    ->with('message',' Order applied, please wait for confirmation.');
    }
    //writer uploading work
    public function upload($id){
        $order = Order::findOrFail($id);

        return view('form.uploadWork', compact('order'));
    }
    public function uploadWork(Request $request){
        //validate input
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,png,jpg,gif,doc,pdf,ppt,pptx,txt,docx,xslx,csv|max:2048',
        ]);

        $order = Order::findOrFail($request->id);


        $path = time().$request->file->getClientOriginalName();

        $request->file->move(public_path('uploads'.DIRECTORY_SEPARATOR.'writers'),$path);

        if($order->filewriter()->exists()){
            $this->fileWriterDel($order);
            $order->update(['status'=>'a_feedback']);
            $order->filewriter()->update(['file_path'=>$path]);
        }else{
            $order->update(['status'=>'a_feedback']);
            $order->filewriter()->create(['file_path'=>$path]);
        }

        return redirect()
                        ->route('a_feedback')
                        ->with('message',' File uploaded');
    }

    // remove writers file
    public function fileWriterDel($order){

        if($order->files()->exists()){
            //get file path
            $path = $order->filewriter()->first()->file_path;


            $path = 'uploads'.DIRECTORY_SEPARATOR.'writers'.DIRECTORY_SEPARATOR.$path;

            //delete file
            if(File::exists(public_path($path))) {
                File::delete(public_path($path));
            }

        }

        return $order;
    }

}
