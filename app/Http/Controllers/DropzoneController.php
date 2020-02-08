<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropzoneController extends Controller
{
  public function dropzone()
  {
      return view('dropzone-view');
  }
  public function dropzoneStore(Request $request)
  {
      $image = $request->file('file');

      $imageName = time().'_'. rand(1000, 9999). '.' .$image->extension();
      $image->move(public_path('test/images'),$imageName);

      return response()->json(['success'=>$imageName]);
  }
} 
