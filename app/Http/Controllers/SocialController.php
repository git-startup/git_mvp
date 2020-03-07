<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Auth;

class SocialController extends Controller
{
    public function getSocial(Request $request)
    {
        $messagesCount = Message::where('to','=',Auth::user()->id)
            ->orwhere('from','=',Auth::user()->id)->count();
        return view('social.index')
            ->with('messagesCount',$messagesCount);
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
    public function searchUsers(Request $request, $user_interest)
    {
        $users = User::where('skills',$user_interest)->get();
        return view('search.users')
                ->with('users',$users);
    }

}
