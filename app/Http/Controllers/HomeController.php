<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Message;
use App\Mvp_type;

class HomeController extends Controller
{

    public function index(){
        if(!Auth::check()){
            return view('index');
        }else{
            $mvp_type = Mvp_type::where('is_active',1)->get();
            return view('social.index')
                    ->with('mvp_type',$mvp_type);
        }
    }
}
