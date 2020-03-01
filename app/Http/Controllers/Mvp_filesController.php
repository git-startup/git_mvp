<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mvp_files;

class Mvp_filesController extends Controller
{
  public function store(Request $request)
  {
    // i disable csrf token protection for this controoler
      $files = $request->file('files');

      foreach ($files as $file) {
        $fileName = time().'_'. rand(1000, 9999). '.' .$file->extension();
        $file->move(public_path('site/mvp/files'),$fileName);

        Mvp_files::create([
          'mvp_id' => $_GET['mvp_id'],
          'url' => $fileName
        ]);

      }
      return response()->json(['success'=>'true']);
  }
}
