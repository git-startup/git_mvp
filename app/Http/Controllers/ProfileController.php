<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mvp;
use App\Status;
use App\Message;
use App\Work;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function getProfile(Request $request,$username){

        $profile = User::where('username',$username)->first();

        if(!$profile){
            return view('errors.404');
        }
        else {
            $mvps = Mvp::where('user_id',Auth::user()->id)->where('is_deleted',0)->get();
            $status = Status::where('user_id',Auth::user()->id)->where('is_deleted',0)->get();
            $check_if_worker = Work::where('worker_id',$profile->id)
                                    ->where('user_id',Auth::user()->id)->count();

            return view('profile.index')
                ->with('profile',$profile)
                ->with('mvps',$mvps)
                ->with('status',$status)
                ->with('check_if_worker',$check_if_worker);
        }

    }

    public function postProfile(Request $request,$username){

        if($request->has('not_available')){
            Mvp::where('id',$request->mvp_id)->update(['is_available' => 0]);
            return redirect()->back()->with('info','تم تعطيل المشروع بنجاح');
        }
        elseif($request->has('is_available')){
            Mvp::where('id',$request->mvp_id)->update(['is_available' => 1]);
            return redirect()->back()->with('info','تم تفعيل المشروع بنجاح');
        }
        elseif($request->input('delete_mvp')){
            Mvp::where('id',$request->mvp_id)->update([
              'is_deleted' => 1
            ]);
            return redirect()->back()->with('info','تم حذف المشروع بنجاح');
        }
        elseif($request->input('delete_status')){
            $status_id = $request->input('status_id');
            Status::where('id',$status_id)->update([
              'is_deleted' => 1
            ]);
            return redirect()->back()->with('info','تم حذف المنشور بنجاح');
        }

        // to contact with user
        if($request->input('btn_contact')){
            $this->validate($request,[
                "message" => 'required|string',
            ],[
                'required' => 'رجاءا قم بكتابة الرسالة  اولا',
            ]);
            Auth::user()->Messenger()->create([
                'message'       => $request->input('message'),
                'to'    => $request->input('to'),
            ]);
            return redirect()->back()->with('info','تم ارسال الرسالة بنجاح');
        }

        // to edit user profile information
        if($request->input('btn_edit_profile')){

            $this->validate($request ,[
                'name'          => 'required|string',
                'phone'         => 'string|required|max:15',
                'location'      => 'string|required',
                'description'   => 'string|required',
                'skills'        => 'string|required',
                'image'         => 'image|mimes:jpeg,jpg,gif,svg,png|max:5120',
            ]);


            if($request->hasFile('image')){
                $image = $request->file('image');
                $input['imagename'] = 'site/profile/logo/'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('site/profile/logo');
                $image->move($destinationPath,$input['imagename']);

                User::where('id',Auth::user()->id)->update([
                    'name'          => $request->input('name'),
                    'location'      => $request->input('location'),
                    'phone'         => $request->input('phone'),
                    'type'          => $request->input('type'),
                    'description'   => $request->input('description'),
                    'skills'        => $request->input('skills'),
                    'image'         => $input['imagename'],
                    'is_completed'  => 1
                ]);
            }else{
                User::where('id',Auth::user()->id)->update([
                    'name'          => $request->input('name'),
                    'location'      => $request->input('location'),
                    'phone'         => $request->input('phone'),
                    'type'          => $request->input('type'),
                    'description'   => $request->input('description'),
                    'skills'        => $request->input('skills'),
                    'is_completed'  => 1 
                ]);
            }

            return redirect()->back()->with('info','تم تحديث البيانات بنجاح');
        }
    }
}
