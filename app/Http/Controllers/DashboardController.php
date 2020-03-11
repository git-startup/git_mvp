<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\Mvp;
use App\Status;
use App\Message;
use App\Tickets;
use App\Category;
use App\Articles;
use App\Mvp_type;
use App\Can_work_on;
use Mail;
use App\Mail\NotifyUsersForNewArticle;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
     // this function is to get the main page in admin panel
    public function getIndex()
    {
        $users_count = User::get()->count();

        $status_count = Status::get()->count();

        $mvps_count = Mvp::get()->count();

        $message_count = Message::get()->count();


        return view('dashboard.index')
                ->with('users_count',$users_count)
                ->with('mvps_count',$mvps_count)
                ->with('message_count',$message_count)
                ->with('status_count',$status_count);

    }
     // to get the users page
    public function getUsers(Request $request){
        $users = User::get();
        $can_work_on = Mvp_type::where('is_active',1)->get();
        return view('dashboard.users')
                ->with('users',$users)
                ->with('can_work_on',$can_work_on);
    }

    public function postUsers(Request $request){

      if($request->has('btn_disable')){
          $user_id = $request->input('user_id');
          User::where('id',$user_id)->update(array('is_disable' => 1));
          return redirect()->back()->with('info' , 'تم تعطيل الحساب');
      }
      elseif($request->has('btn_able')){
          $user_id = $request->input('user_id');
          User::where('id',$user_id)->update(array('is_disable' => 0));
          return redirect()->back()->with('info' , 'تم تفعيل الحساب');
      }


      $can_work_on = json_encode($request->can_work_on,JSON_UNESCAPED_UNICODE);
      Can_work_on::where('user_id',$request->user_id)
        ->update([
          'name' => $can_work_on,
          'rating' => $request->rating
        ]);

      return redirect()->back()->with('info','تم تحديث البيانات بنجاح');
    }

    // register new developer
    public function getAdd_user(Request $request){
        return view('dashboard.add_user');
    }

    public function postAdd_user(Request $request){
        $this->validate($request,[
            'email'      => 'required|unique:users|email|max:255',
            'name'       => 'required|string',
            'phone'      => 'required|string|min:10',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        if($request->input('gender') == 'male'){
            $avatar = asset('site/profile/logo/avatar.png');
        }elseif($request->input('gender') == 'female'){
            $avatar = asset('site/profile/logo/avatar2.png');
        }


        $user = User::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'type' => $request->type,
            'image'    => $avatar,
            'password' => Hash::make($request->input('password')),
        ]);


        Can_work_on::create([
          'user_id' => $user->id
        ]);

        return redirect()->back()->with('info','تم اضافة مستخدم بنجاح');
    }

    // to get the projects page
    public function getMvp(Request $request){
        $mvps = Mvp::get();
        return view('dashboard.mvp')
                ->with('mvps',$mvps);
    }

    public function postMvp(Request $request){
        if($request->has('delete_mvp')){
            Mvp::where('id','=',$request->mvp_id)->update([
              'is_deleted' => 1
            ]);
            return redirect()->back()->with('info','تم حذف المشروع بنجاح');
        }
        // to approve the mvp
        if($request->has('approved')){
            Mvp::where('id','=',$request->mvp_id)->update(['is_approved' => 1]);
            return redirect()->back()->with('info','تمت الموافقة على المشؤوع');
        }
        elseif($request->has('reject')){
            Mvp::where('id','=',$request->mvp_id)->update(['is_approved' => 0]);
            return redirect()->back()->with('info','تم رفض المشروع');
        }
    }

    // manage mvp type
    public function getAdd_mvp_type(){
      return view('dashboard.add_mvp_type');
    }
    public function postAdd_mvp_type(Request $request){
      $this->validate($request,[
        'name' => 'required|string',
        'slug' => 'required|string|unique:mvp_type',
      ]);
      Mvp_type::create([
        'name' => $request->name,
        'slug' => $request->slug,
        'is_active' => 1
      ]);
      return redirect()->back()->with('info','تمت اضافة النوع بنجاح');
    }
    public function getMvp_type(){
      $type = Mvp_type::where('is_active',1)->get();
      return view('dashboard.mvp_type')->with('type',$type);
    }
    public function postMvp_type(Request $request){
      if($request->has('delete_type')){
        Mvp_type::where('id',$request->type_id)->delete();
        return redirect()->back()->with('info','تم حذف النوع بنجاح');
      }
    }

    // to get users posts
     public function getStatus(Request $request){

         if($request->has('delete_status')){
             Status::where('id','=',$request->input('status_id'))->update([
               'is_deleted' => 1
             ]);
             return redirect()->back()->with('info','تم حذف المنشور بنجاح');

         }
         // to get all status and posts
        $status = Status::orderBy('created_at','desc')->where('is_deleted','<>', 1)->get();

         return view('dashboard.status')
                ->with('status',$status);

     }

     // to publish new article
	public function getPublishArticle(){
		$category = Category::where('is_active',1)->get();
		return view('dashboard.publish_article')
					->with('category',$category);
	}
	public function postPublishArticle(Request $request){

  		$this->validate($request,[
  			'heading' 		 => 'required|string',
  			'slug'	  		 => 'required|string|unique:articles',
  			'content' 		 => 'required|string',
  			'image'   		 => 'required|image|mimes:jpg,png,jpeg,svg',
  			'bottom_image'   => 'image|mimes:jpg,png,jpeg,svg'
  		]);

  		$newArticle['heading']        = $request->heading;
  		$newArticle['sub_heading']    = $request->sub_heading;
  		$newArticle['slug']    		  = $request->slug;
  		$newArticle['content'] 		  = $request->content;
  		$newArticle['bottom_content'] = $request->bottom_content;
  		$newArticle['category_id']    = $request->category_id;
  		$newArticle['language']       = $request->language;
      $newArticle['user_id']        = Auth::user()->id;

      // to upload article image
      if($request->hasFile('image')){
      	$image = $request->file('image');
        $imageUrl = 'site/articles/'.time().'.'.'main_image'.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/site/articles');
        $image->move($destinationPath,$imageUrl);
        $image = $imageUrl;

        $newArticle['image'] = $image;
      }
      // to upload bottom image
      if($request->hasFile('bottom_image')){
      	$image = $request->file('bottom_image');
        $imageUrl = 'site/articles/'.time().'.'.'sub_image'.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/site/articles');
        $image->move($destinationPath,$imageUrl);
        $bottom_image = $imageUrl;

        $newArticle['bottom_image'] = $bottom_image;
      }

      $newArticle = Articles::create($newArticle);

      //Notify all users about the new article
      foreach (User::get() as $user) {
          Mail::to($user->email)->queue(new NotifyUsersForNewArticle($newArticle, $user));
      }

      return redirect()->back()->with('info','تم نشر المقالة');
	}
	// to list all published articles
	public function getArticles(){
		$articles = Articles::OrderBy('created_at','desc')->where('is_deleted','<>',1)->get();
		return view('dashboard.articles')
					->with('articles',$articles);

	}
	public function postArticles(Request $request){
		if($request->has('btn_update')){
      $category = Category::where('is_active',1)->get();
			$article = Articles::where('id',$request->article_id)->first();
			return view('dashboard.edit_article')
						->with('article',$article)
            ->with('category',$category);
		}
		if($request->has('update_article')){
			$this->validate($request,[
				'heading'        => 'required|string',
				'content'        => 'required|string'
			]);

	     // to upload article image
      if($request->hasFile('image')){
      	$image = $request->file('image');
        $imageUrl = 'site/articles/'.time().'.'.'main_image'.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/site/articles');
        $image->move($destinationPath,$imageUrl);
      }else{
      	$article_info = Articles::where('id',$request->article_id)->first();
      	$imageUrl = $article_info->image;
      }

      // to upload article bottom image
      if($request->hasFile('bottom_image')){
      	$image = $request->file('bottom_image');
        $imageUrl = 'site/articles/'.time().'.'.'sub_image'.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/site/articles');
        $image->move($destinationPath,$imageUrl);
      }else{
      	$article_info = Articles::where('id',$request->article_id)->first();
      	$bottomImageUrl = $article_info->bottom_image;
      }

			Articles::where('id',$request->article_id)->update([
				'heading' 	     => $request->heading,
				'sub_heading'    => $request->sub_heading,
				'content' 	     => $request->content,
				'bottom_content' => $request->bottom_content,
				'category_id'    => $request->category_id,
				'language' 	     => $request->language,
				'image'          => $imageUrl,
				'bottom_image'   => $bottomImageUrl
			]);

			return redirect()->back()->with('info','تم تحديث بيانات المقالة');

		}
		if($request->has('delete_article')){
			Articles::where('id',$request->article_id)->update([
        'is_deleted' => 1
      ]);
			return redirect()->back()->with('info','تم حذف المقالة');
		}
		if($request->has('publish_btn')){
			Articles::where('id',$request->article_id)->update([
				'is_published' => 1
			]);
			return redirect()->back()->with('info','تم نشر المقالة');
		}
		if($request->has('dis_publish_btn')){
			Articles::where('id',$request->article_id)->update([
				'is_published' => 0
			]);
			return redirect()->back()->with('info','تم تعليق نشر المقالة');
		}
	}

    // to manage articles category's
    public function getAddCategory(){
        return view('dashboard.addCategory');
    }
    public function postAddCategory(Request $request){
        $this->validate($request,[
            'name' => 'string|required',
            'slug' => 'string|required'
        ]);
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id
        ]);
        return redirect()->back()->with('info','تمت اضافة التصنيف');
    }

    // to get all articles category
    public function getCategory(){
        $category = Category::get();
        return view('dashboard.category')
                ->with('category',$category);
    }
    public function postCategory(Request $request){
        if($request->has('delete_category')){
            Category::where('id',$request->category_id)->delete();
            return redirect()->back()->with('info','تم حذف التصنيف');
        }
    }

	// for settings
     public function getSettings(){
         $settings = DB::table('settings')->first();
         return view('dashboard.settings')
                ->with('settings',$settings);
     }

     public function getTickets(Request $request){

        if($request->has('delete_ticket')){
            Tickets::where('id','=',$request->ticket_id)->update([
              'is_deleted' => 1
            ]);
            return redirect()->back()->with('info','تم حذف التذكرة بنجاح');
        }

        if($request->has('close_ticket')){
            Tickets::where('id',$request->ticket_id)->update([
                'is_closed' => 1
            ]);
            return redirect()->back()->with('info','تم اغلاق التذكرة');
        }

        $tickets = Tickets::where('is_deleted', '<>', 1)->get();

        return view('dashboard.tickets')
            ->with('tickets',$tickets);
     }

}
