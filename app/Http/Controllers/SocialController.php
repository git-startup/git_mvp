<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Mvp_type;
use App\Can_work_on;
use Auth;

class SocialController extends Controller
{
    public function getSocial(Request $request)
    {
        $mvp_type = Mvp_type::where('is_active',1)->get();
        return view('social.index')
                  ->with('mvp_type',$mvp_type);
    }

    // to send new message
    public function postSocial(Request $request)
    {
        $this->validate($request,[
            'message' => 'required|string',
        ],[
            'required' => 'رجاءا قم بملئ حقل الرسالة',
            'string' => 'حقل الرسالة يجب ان يحتوي على نص فقط'
        ]);

        if(Auth::user()->id != $request->to){
            $message = Auth::user()->Messenger()->create([
                'message' => $request->input('message'),
                'to'      => $request->input('to'),
                'from'    => Auth::user()->id,

            ]);
            return response()->json($message);
        }
        else return 'false';
    }

    // to get users by they account type
    public function searchUsers(Request $request, $can_work_on)
    {
        $mvp_type = Mvp_type::where('is_active',1)->get();
        $results = Can_work_on::whereJsonContains('name',$can_work_on)->get();

        return view('search.users')
                ->with('results',$results)
                ->with('mvp_type',$mvp_type);
    }

}
