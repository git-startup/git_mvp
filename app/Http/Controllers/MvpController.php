<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mvp;
use App\Mvp_type;
use App\User;

class MvpController extends Controller{

	// to get add mvp page
	public function getAdd(){
			$users = User::where('is_deleted',0)->where('is_disable',0)->get();
			$mvp_types = Mvp_type::where('is_active',1)->get();
      return view('mvp.add')
			 				->with('users',$users)
							->with('mvp_types',$mvp_types);
    }
    // to add mvp
    public function postAdd(Request $request){

    	$this->validate($request,[
            'name'            => 'required|string',
            'type'            => 'required|string',
            'description'     => 'required|string',
            'slug'            => 'required|string|unique:mvp',
            'mvp_link'        => 'required|url',
            'dev_tools'       => 'required|string'
        ],[
            'required'  => 'رجاءا قم بملئ هذا الحقل اولا',
            'string'    => 'هذا الحقل يجب ان يحتوي على بيانات نصية',
            'max'       => 'حجم الملف اكبر من حجم الملف المسموح به في هذا الحقل',
            'mimes'     => 'نوع الملف غير مسموح به',
						'url'       => 'الرجاء ادخال رابط صحيح'
        ]);

        $mvp = Auth::user()->mvps()->create([
            'name'        => $request->name,
            'type'        => $request->type,
            'description' => $request->description,
            'slug'        => $request->slug,
            'dev_tools'   => $request->dev_tools,
            'mvp_link'    => $request->mvp_link,
						'is_deleted'  => 0
        ]);

	    return view('mvp.index',['slug' => $request->slug])
								->with('mvp',$mvp);
	}

	// to get single mvp
	public function getMvp($slug){
		$mvp = Mvp::where('slug',$slug)
							->where('is_approved',1)
							->where('is_available',1)
							->where('is_deleted',0)->first();

		// get all users for add feature users datalist
		$users = User::where('is_deleted',0)->where('is_disable',0)->get();

		if($mvp){
				return view('mvp.index')->with('mvp',$mvp)->with('users',$users);
		}else{
			return redirect()->back()->with('info','هذا المشروع غير متاح حاليا');
		}
 	}
    // to get edit mvp page
    public function getEditMvp($slug){
        $mvp = Mvp::where('slug',$slug)->first();
        if($mvp->count()){
			return view('mvp.edit')
		    	->with('mvp',$mvp);
		}else{
			return redirect()->back()->with('info','الرجاء التأكد من العنوان الصحيح');
		}
    }
    // to edit mvp data
    public function postEditMvp(Request $request,$slug){
	    if($request->has('btn_edit_mvp')){
				$this->validate($request,[
						'name'            => 'required|string',
						'type'            => 'required|string',
						'description'     => 'required|string',
						'mvp_link'        => 'required|url',
						'dev_tools'       => 'required|string'
				],[
						'required'  => 'رجاءا قم بملئ هذا الحقل اولا',
						'string'    => 'هذا الحقل يجب ان يحتوي على بيانات نصية',
						'max'       => 'حجم الملف اكبر من حجم الملف المسموح به في هذا الحقل',
						'mimes'     => 'نوع الملف غير مسموح به',
						'url'       => 'الرجاء ادخال رابط صحيح'
				]);

        Mvp::where('id',$request->mvp_id)->update([
          'name'           => $request->input('name'),
          'type'           => $request->input('type'),
          'description'    => $request->input('description'),
          'dev_tools'      => $request->input('dev_tools'),
          'mvp_link'       => $request->mvp_link
        ]);

        return redirect()
            ->back()
            ->with('info','تم تحديث بيانات المشروع ');
	    }

	}

	// list all mvps
	public function list(){
		$mvps = Mvp::orderBy('created_at','desc')
					->where('is_approved',1)
					->where('is_available',1)
					->where('is_deleted',0)->get();
		$mvp_type = Mvp_type::where('is_active',1)->get();

		return view('mvp.list')
				->with('mvps',$mvps)
				->with('mvp_type',$mvp_type);
	}

	public function search($type){
		$mvps = Mvp::where('type',$type)->get();
		$mvp_type = Mvp_type::where('is_active',1)->get();

		return view('mvp.list')
				->with('mvps',$mvps)
				->with('mvp_type',$mvp_type);
	}

}
