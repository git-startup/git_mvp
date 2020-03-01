<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mvp_files extends Model
{
  protected $table = 'mvp_files';
  protected $fillable = [
    'mvp_id',
    'url'
  ];

  public function mvp(){
    return $this->belongsTo(Mvp::class,'mvp_id');
  }
}
