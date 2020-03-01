<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mvp_features;

class Mvp_featuresController extends Controller
{
  public function store(Request $request)
  {
      $file = $request->file('file');

      $fileName = time().'_'. rand(1000, 9999). '.' .$file->extension();
      $file->move(public_path('site/mvp/features/files'),$fileName);

      Mvp_features::create([
        'name' => $request->name,
        'description' => $request->description,
        'mvp_id' => $_GET['mvp_id'],
        'url' => $fileName
      ]);

      return response()->json(['success'=>'true']);
  }
}
