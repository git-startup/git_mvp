<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Message;
use App\Events\workNotification;

class workController extends Controller
{
    public function getIndex(){
        $workers = Auth::user()->workers();
        $requests = Auth::user()->workRequest();

        $requests_pending = Auth::user()->workRequestPending();

        return view('workers.index')
        ->with('workers',$workers)
        ->with('requests',$requests)
        ->with('requests_pending',$requests_pending);

    }

    public function getAdd($id){
        $user = User::where('id',$id)->first();
        if(!$user){
            return response()->json('that user could not be found');
        }

        if(Auth::user()->id === $user->id){
            return response()->json('cannot send request to your self');
        }

        // test this line
        if(Auth::user()->hasWorkRequestPending($user) || $user->hasWorkRequestPending(Auth::user()) ){
            return response()->json('request alredy pending .');
        }

        if(Auth::user()->isWorkWith($user)){
            return response()->json('you are alredy worker ');
        }

        Auth::user()->addWorker($user);

        broadcast(new workNotification($user));

        return response()->json($user);

    }

    public function getAccept($id){

        $user = User::where('id',$id)->first();
        if(!$user){
            return redirect()->route('home')->with('info','that user could not be found');
        }

        if(!Auth::user()->hasWorkRequestRecived($user)){
            return redirect()->route('home');
        }

        Auth::user()->acceptWorkRequest($user);
        return redirect()
            ->route('home')
            ->with('info','friend request accepted.');
    }

    public function postDelete($id){
        $user = User::where('id',$id)->first();
        if(!Auth::user()->isWorkWith($user)){
            return redirect()->back();
        }
        Auth::user()->deleteWorker($user);
        return redirect()->back()->with('info','friend deleted');
    }
}
