<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mvp_gallery;

class Mvp_galleryController extends Controller
{
  public function store(Request $request)
  {
      $images = $request->file('files');

      foreach ($images as $image) {
        $imageName = time().'_'. rand(1000, 9999). '.' .$image->extension();
        $image->move(public_path('site/mvp/images'),$imageName);

        Mvp_gallery::create([
          'mvp_id' => $_GET['mvp_id'],
          'url' => $imageName
        ]);

      }
      return response()->json(['success'=>'true']);
  }
}
