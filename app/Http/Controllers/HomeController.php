<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Message;

class HomeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::check()){

            return view('index');
        }
        else{
            
            $messagesCount = Message::where('to','=',Auth::user()->id)
            ->orwhere('from','=',Auth::user()->id)->count();
            
            return view('social.index')
                    ->with('messagesCount',$messagesCount);
                    
        }
    }
}
