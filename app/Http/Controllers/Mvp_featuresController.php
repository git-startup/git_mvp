<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mvp_features;

class Mvp_featuresController extends Controller
{
  public function store(Request $request)
  {
      if($request->hasFile('file')){
          $file = $request->file('file');
          $input['filename'] = 'site/mvp/features/files/'.time().'.'.$file->getClientOriginalExtension();
          $destinationPath = public_path('/site/profile/logo');
          $file->move($destinationPath,$input['filename']);

          $feature_file = $input['filename'];
      }else{
        $feature_file = '';
      }


      Mvp_features::create([
        'name' => $request->name,
        'description' => $request->description,
        'mvp_id' => $request->mvp_id,
        'url' => $feature_file
      ]);

      return redirect()->back()->with('info','تمت اضافة الخاصية بنجاح');
  }
}
