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
            'price'           => 'required',
            'mvp_file'        => 'required|mimes:zip|max:5120',
            'dev_tools'       => 'required|string',
            'how_to_use_file' => 'required|mimes:txt,doc,docx,pdf|max:5120',
            'image_one'       => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'image_two'       => 'image|mimes:jpeg,jpg,png|max:5120',
            'image_three'     => 'image|mimes:jpeg,jpg,png|max:5120',
        ],[
            'required'  => 'رجاءا قم بملئ هذا الحقل اولا',
            'string'    => 'هذا الحقل يجب ان يحتوي على بيانات نصية',
            'max'       => 'حجم الملف اكبر من حجم الملف المسموح به في هذا الحقل',
            'mimes'     => 'نوع الملف غير مسموح به'
        ]);

    	// to upload mvp file 
        if ($request->hasFile('mvp_file')) {
            $mvp_file = $request->file('mvp_file');
            $input['imagename'] = 'site/mvp/files/'.time().'_mvp_file_'.Auth::user()->id.'.'.$mvp_file->getClientOriginalExtension();
            $destinationPath = public_path('/site/mvp/files');
            $mvp_file->move($destinationPath,$input['imagename']);
            $mvp_file = $input['imagename'];
        }
        // =====================================================================

        // to upload mvp how to use file
        if ($request->hasFile('how_to_use_file')) {
            $mvp_how_to_use_file = $request->file('how_to_use_file');
            $input['imagename'] = 'site/mvp/files/'.time().'_how_to_use_file_'.Auth::user()->id.'.'.$mvp_how_to_use_file->getClientOriginalExtension();
            $destinationPath = public_path('/site/mvp/files');
            $mvp_how_to_use_file->move($destinationPath,$input['imagename']);
            $mvp_how_to_use_file = $input['imagename'];
        }
        // =====================================================================

    	// to upload mvp image two
        if ($request->hasFile('image_one')) {
            $mvp_image_one = $request->file('image_one');
            $input['imagename'] = 'site/mvp/images/'.time().'_mvp_image_one_'.Auth::user()->id.'.'.$mvp_image_one->getClientOriginalExtension();
            $destinationPath = public_path('/site/mvp/images');
            $mvp_image_one->move($destinationPath,$input['imagename']);
            $mvp_image_one = $input['imagename'];
        }
        // =====================================================================

        // to upload mvp image two
        if ($request->hasFile('image_two')) {
            $mvp_image_two = $request->file('image_two');
            $input['imagename'] = 'site/mvp/images/'.time().'_mvp_image_two_'.Auth::user()->id.'.'.$mvp_image_two->getClientOriginalExtension();
            $destinationPath = public_path('/site/mvp/images');
            $mvp_image_two->move($destinationPath,$input['imagename']);
            $mvp_image_two = $input['imagename'];
        }else{$mvp_image_two = '';}
        // =====================================================================

        // to upload mvp image three
        if ($request->hasFile('image_three')) {
            $mvp_image_three = $request->file('image_three');
            $input['imagename'] = 'site/mvp/images/'.time().'_mvp_image_three_'.Auth::user()->id.'.'.$mvp_image_three->getClientOriginalExtension();
            $destinationPath = public_path('/site/mvp/images');
            $mvp_image_three->move($destinationPath,$input['imagename']);
            $mvp_image_three = $input['imagename'];
        }else{$mvp_image_three = '';}
        // =====================================================================

        Auth::user()->mvps()->create([
            'name'               => $request->input('name'),
            'type'               => $request->input('type'), 
            'description'        => $request->input('description'), 
            'slug'         		 => $request->input('slug'),
            'price'              => $request->input('price'),
            'dev_tools'      	 => $request->input('dev_tools'),
            'how_to_use_file'    => $mvp_how_to_use_file,
            'mvp_file'           => $mvp_file,
            'image_one'          => $mvp_image_one,
            'image_two'          => $mvp_image_two,
            'image_three'        => $mvp_image_three,
        ]);            

	    return redirect()
	        ->back()
	        ->with('info','شكرا لاختيارك التعامل معنا سيتم التواصل معك قريبا ');
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
	            'price'           => 'required',
	            'mvp_file'        => 'mimes:zip|max:5120',
	            'dev_tools'       => 'string',
	            'how_to_use_file' => 'mimes:txt,doc,docx,pdf|max:5120',
	            'image_one'       => 'image|mimes:jpeg,jpg,png|max:5120',
	            'image_two'       => 'image|mimes:jpeg,jpg,png|max:5120',
	            'image_three'     => 'image|mimes:jpeg,jpg,png|max:5120',
	        ],[
	            'required'  => 'رجاءا قم بملئ هذا الحقل اولا',
	            'string'    => 'هذا الحقل يجب ان يحتوي على بيانات نصية',
	            'max'       => 'حجم الملف اكبر من حجم الملف المسموح به في هذا الحقل',
	            'mimes'     => 'نوع الملف غير مسموح به'
	        ]);

	        // to get the old file if no file has been uploaded
	        $mvp = Mvp::where('slug',$slug)->first();

	        // to upload mvp file 
	        if ($request->hasFile('mvp_file')) {
	            $mvp_file = $request->file('mvp_file');
	            $input['imagename'] = 'site/mvp/files/'.time().'_mvp_file_'.Auth::user()->id.'.'.$mvp_file->getClientOriginalExtension();
	            $destinationPath = public_path('/site/mvp/files');
	            $mvp_file->move($destinationPath,$input['imagename']);
	            $mvp_file = $input['imagename'];
	        }else{$mvp_file = $mvp->mvp_file;}
	        // =====================================================================

	        // to upload mvp how to use file
	        if ($request->hasFile('how_to_use_file')) {
	            $mvp_how_to_use_file = $request->file('how_to_use_file');
	            $input['imagename'] = 'site/mvp/files/'.time().'_how_to_use_file_'.Auth::user()->id.'.'.$mvp_how_to_use_file->getClientOriginalExtension();
	            $destinationPath = public_path('/site/mvp/files');
	            $mvp_how_to_use_file->move($destinationPath,$input['imagename']);
	            $mvp_how_to_use_file = $input['imagename'];
	        }else{$mvp_how_to_use_file = $mvp->how_to_use_file;}
	        // =====================================================================

	    	// to upload mvp image two
	        if ($request->hasFile('image_one')) {
	            $mvp_image_one = $request->file('image_one');
	            $input['imagename'] = 'site/mvp/images/'.time().'_mvp_image_one_'.Auth::user()->id.'.'.$mvp_image_one->getClientOriginalExtension();
	            $destinationPath = public_path('/site/mvp/images');
	            $mvp_image_one->move($destinationPath,$input['imagename']);
	            $mvp_image_one = $input['imagename'];
	        }else{$mvp_image_one = $mvp->image_one;}
	        // =====================================================================

	        // to upload mvp image two
	        if ($request->hasFile('image_two')) {
	            $mvp_image_two = $request->file('image_two');
	            $input['imagename'] = 'site/mvp/images/'.time().'_mvp_image_two_'.Auth::user()->id.'.'.$mvp_image_two->getClientOriginalExtension();
	            $destinationPath = public_path('/site/mvp/images');
	            $mvp_image_two->move($destinationPath,$input['imagename']);
	            $mvp_image_two = $input['imagename'];
	        }else{$mvp_image_two = $mvp->image_two;}
	        // =====================================================================

	        // to upload mvp image three
	        if ($request->hasFile('image_three')) {
	            $mvp_image_three = $request->file('image_three');
	            $input['imagename'] = 'site/mvp/images/'.time().'_mvp_image_three_'.Auth::user()->id.'.'.$mvp_image_three->getClientOriginalExtension();
	            $destinationPath = public_path('/site/mvp/images');
	            $mvp_image_three->move($destinationPath,$input['imagename']);
	            $mvp_image_three = $input['imagename'];
	        }else{$mvp_image_three = $mvp->image_three;}
	        // =====================================================================

            Mvp::where('id',$request->mvp_id)->update([
                'name'               => $request->input('name'),
	            'type'               => $request->input('type'), 
	            'description'        => $request->input('description'), 
	            'price'              => $request->input('price'),
	            'dev_tools'      	 => $request->input('dev_tools'),
	            'how_to_use_file'    => $mvp_how_to_use_file,
	            'mvp_file'           => $mvp_file,
	            'image_one'          => $mvp_image_one,
	            'image_two'          => $mvp_image_two,
	            'image_three'        => $mvp_image_three,
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
