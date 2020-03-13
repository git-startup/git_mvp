<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mvp_features;
use App\User;

class Mvp_featuresController extends Controller
{
  public function store(Request $request)
  {

      $this->validate($request,[
        'name'            => 'required|string',
        'username'        => 'required|string',
        'description'     => 'required|string',
        'file'            => 'required|mimes:jpeg,jpg,gif,svg,png,zip,pdf,docs|max:50120'
      ],[
          'required'  => 'رجاءا قم بملئ هذا الحقل اولا',
          'string'    => 'هذا الحقل يجب ان يحتوي على بيانات نصية',
          'max'       => 'حجم الملف اكبر من حجم الملف المسموح به في هذا الحقل',
          'mimes'     => 'نوع الملف غير مسموح به',
          'url'       => 'الرجاء ادخال رابط صحيح'
      ]);

      $check_if_user_exist = User::where('username',$request->username)->first();
      if($check_if_user_exist->count() == 0){
        return redirect()->back()->with('info','المستخدم الذي احترته غير موجود');
      }

      if($request->hasFile('file')){
          $file = $request->file('file');
          $input['filename'] = 'site/mvp/features/files/'.time().'.'.$file->getClientOriginalExtension();
          $destinationPath = public_path('site/mvp/features/files');
          $file->move($destinationPath,$input['filename']);
          $feature_file = $input['filename'];
      }

      Mvp_features::create([
        'name' => $request->name,
        'username'   => $request->username,
        'description' => $request->description,
        'mvp_id' => $request->mvp_id,
        'url' => $feature_file
      ]);

      return redirect()->back()->with('info','تمت اضافة الخاصية بنجاح');
  }
}
