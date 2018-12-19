<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Order;

class SearchController extends Controller
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

    public function searchWriters(Request $request){
        $needle = $request->search;

        $writers = User::where('fname','LIKE','%'.$needle.'%')
                                ->orWhere('lname','LIKE','%'.$needle.'%')
                                ->get();
    }
}
