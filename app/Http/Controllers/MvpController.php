<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mvp;

class MvpController extends Controller{

	// to get add mvp page
	public function getAdd(){
       return view('mvp.add');
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
            'mvp_link'    => $request->mvp_link
        ]);

	    return view('mvp.index',['slug' => $request->slug])
								->with('mvp',$mvp);
	}

	// to get single mvp
	public function getMvp($slug){
		$mvp = Mvp::where('slug',$slug)->first();
		if($mvp){
			return view('mvp.index')
		    	->with('mvp',$mvp);
		}else{
			return redirect()->back()->with('info','الرجاء التأكد من العنوان الصحيح');
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
	            'mvp_file'        => 'required|url',
	            'dev_tools'       => 'required|string',
	            'image_one'       => 'image|mimes:jpeg,jpg,png|max:5120',
	            'image_two'       => 'image|mimes:jpeg,jpg,png|max:5120',
	            'image_three'     => 'image|mimes:jpeg,jpg,png|max:5120',
	        ],[
	            'required'  => 'رجاءا قم بملئ هذا الحقل اولا',
	            'string'    => 'هذا الحقل يجب ان يحتوي على بيانات نصية',
	            'max'       => 'حجم الملف اكبر من حجم الملف المسموح به في هذا الحقل',
	            'mimes'     => 'نوع الملف غير مسموح به',
							'url'       => 'الرجاء ادخال رابط صحيح'
	        ]);

            Mvp::where('id',$request->mvp_id)->update([
              'name'               => $request->input('name'),
	            'type'               => $request->input('type'),
	            'description'        => $request->input('description'),
	            'dev_tools'      	 => $request->input('dev_tools'),
	            'mvp_link'           => $request->mvp_link
            ]);

            return redirect()
                ->back()
                ->with('info','تم تعديل المشروع بنجاح');
	    }

	}

	// list all mvps
	public function list(){
		$mvps = Mvp::orderBy('created_at','desc')
					->where('is_approved',1)
					->where('is_available',1)
					->get();
		return view('mvp.list')
				->with('mvps',$mvps);
	}

	public function search($type){
		$mvps = Mvp::where('type',$type)->get();
		return view('mvp.list')
				->with('mvps',$mvps);
	}

}
