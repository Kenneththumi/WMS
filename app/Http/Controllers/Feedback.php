<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Order;

use App\Message;

class Feedback extends Controller
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
            $messages = Message::paginate(5);
            return view('records.feedback',compact('messages'));
        }
        else{
            $messages = [];
            if(Order::where('user_id',auth()->user()->id)->exists()){
                $messages = Order::where('user_id',auth()->user()->id)->firstOrFail()->messages()->simplePaginate(8);
            }

            return view('records.writer.feedback',compact('messages'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Remove the specified resources from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if (empty($request->chk)) {
            return back()->withErrors('No selection was made');
        }


        $items = count($request->chk);

        for ($i = 0; $i < $items; $i++) {
            $id = $request->chk[$i];

            Message::findOrFail($id)->delete();
        }


        return back()
            ->with('message', 'Item(s) deleted');
    }
}
