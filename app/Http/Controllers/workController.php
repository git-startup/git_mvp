<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon;
use App\User;
use App\Work;
use App\Mvp_type;
use App\Message;
use App\Events\workNotification;

class workController extends Controller
{
    public function getIndex(){

        $requests = Work::where('worker_id',Auth::user()->id)
                        ->where('accepted',0)
                        ->where('is_deleted',0)->with('user')->get();

        $requests_pending = Work::where('user_id',Auth::user()->id)
                        ->where('accepted',0)
                        ->where('is_deleted',0)->get();

        $mvp_type = Mvp_type::where('is_active',1)->get();

        return view('workers.index')
        ->with('requests',$requests)
        ->with('requests_pending',$requests_pending)
        ->with('mvp_type',$mvp_type);

    }

    public function addWorker(Request $request){

        $user = User::where('id',$request->worker_id)->first();
        if(!$user){
            return response()->json('هذا المستخدم غير موجود حاليا');
        }
        if(Auth::user()->id === $user->id){
            return response()->json('لا يمكنك ارسال طلب عمل لنفسك');
        }

        Work::create([
          'user_id'          => Auth::user()->id,
          'worker_id'        => $user->id,
          'accepted'         => 0,
          'work_title'       => $request->work_title,
          'agreement'        => $request->agreement,
          'start_of_agreement' => Carbon\Carbon::parse($request->date_range[0])->toDateTimeString(),
          'end_of_agreement' => Carbon\Carbon::parse($request->date_range[1])->toDateTimeString(),
          'sallery' => $request->sallery,
          'is_deleted' => 0
        ]);

        broadcast(new workNotification($user));

        return response()->json($user);

    }

    public function postAccept(Request $request){

        Work::where('id',$request->work_id)->update([
          'accepted' => 1
        ]);

        return response()->json([
          'message' => 'تم قبول طلب العمل'
        ]);

    }

    public function postEdit(Request $request){

      $this->validate($request,[
        'work_title' => 'required|string',
        'start_of_agreement' => 'required|date',
        'end_of_agreement' => 'required|date',
        'sallery' => 'required|integer',
        'agreement' => 'required|string'
      ]);



      Work::where('id',$request->work_id)->update([
        'work_title' => $request->work_title,
        'start_of_agreement' => $request->start_of_agreement,
        'end_of_agreement' => $request->end_of_agreement,
        'sallery' => $request->sallery,
        'agreement' => $request->agreement,
      ]);

      return redirect()->back()->with('info','تم تحديث البيانات بنجاح  ');
    }

    public function postReject(Request $request){
      Work::where('id',$request->work_id)->update([
        'accepted' => 0
      ]);

      return redirect()->back()->with('info','  تم رفض الطلب بنجاح ');
    }

    public function postDelete(Request $request){
        Work::where('id',$request->work_id)->update([
          'is_deleted' => 1
        ]);

        return redirect()->back()->with('info','تم حذف الطلب بنجاح');
    }
}
