<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mvp;
use App\Status;
use App\Message;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function getProfile(Request $request,$user_id){

        $profile = User::find($user_id);

        if(!$profile){
            return view('errors.404');
        }
        else {
            $mvps = Mvp::where('user_id',Auth::user()->id)->where('is_deleted',0)->get();
            $status = Status::where('user_id',Auth::user()->id)->where('is_deleted',0)->get();

            return view('profile.index')
                ->with('profile',$profile)
                ->with('mvps',$mvps)
                ->with('status',$status);
        }

    }

    public function postProfile(Request $request,$userid){

        if($request->has('not_available')){
            Mvp::where('id',$request->mvp_id)->update(['is_available' => 0]);
            return redirect()->back()->with('info','تم تعطيل المشروع بنجاح');
        }
        elseif($request->has('is_available')){
            Mvp::where('id',$request->mvp_id)->update(['is_available' => 1]);
            return redirect()->back()->with('info','تم تفعيل المشروع بنجاح');
        }
        elseif($request->input('delete_mvp')){
            //$getMvp = Mvp::where('id','=',$request->mvp_id)->first();
            //to delete the Mvp image's files
            //File::delete($getMvp->image_one);
            //File::delete($getMvp->image_two);
            //File::delete($getMvp->image_three);
            // to delete the mvp record from db
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
                'name'          => 'string|nullable',
                'phone'         => 'string|nullable|max:15',
                'location'      => 'string|nullable',
                'description'   => 'string|nullable',
                'skills'        => 'string|nullable',
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
                ]);
            }else{
                User::where('id',Auth::user()->id)->update([
                    'name'          => $request->input('name'),
                    'location'      => $request->input('location'),
                    'phone'         => $request->input('phone'),
                    'type'          => $request->input('type'),
                    'description'   => $request->input('description'),
                    'skills'        => $request->input('skills'),
                ]);
            }

            return redirect()->back()->with('info','تم تحديث البيانات بنجاح');
        }
    }
}
