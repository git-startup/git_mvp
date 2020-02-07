<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use App\Comment;
use App\User;
use Auth;


class StatusController extends Controller
{
    public function getStatus(){

        $statuses = Status::where('is_published',1)
                          ->with('comments')
                          ->with('user')
                          ->orderBy('created_at','desc')
                          ->get(); 


        return response()->json($statuses);
    }


 	  public function postStatus(Request $request){
        $this->validate($request,[
           'status' => 'required|string|max:250',
        ],[
            'required' => 'رجاءا قم بكتابة البوست اولا',
        ]);
        
        $status = Auth::user()->statuses()->create([
           'body'          => $request->input('status'),
           'type'          => 'status',
        ]);

        return response()->json($status);
        
    }


    public function get_status_with_user($status_id){
      $status = Status::where('id',$status_id)->with('user')->first();
      return response()->json($status);
    }
     
    public function postComment(Request $request){

        $comment = Comment::create([ 
            'status_id' => $request->input('status_id'),
            'content'    => $request->input('content'),
            'user_id'    => $request->input('user_id')

        ]);

      return response()->json($comment);
    }
    

    public function getLike($statusId){
        
        $status = Status::find($statusId);
        
        if(!$statusId){
           dd();
        }
        
        if(Auth::user()->hasLikedStatus($status)){
            echo $status->likes()->count() . ' likes';
            dd();
        }
        
        $like = $status->likes()->create([]);
        Auth::user()->likes()->save($like);

        Status::where('id','=',$statusId)->update([
          'likes' => $status->likes()->count()
        ]);

        return response()->json($status->likes()->count());

        
    }
}
