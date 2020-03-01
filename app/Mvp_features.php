<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mvp_features extends Model
{
  protected $table = 'mvp_features';
  protected $fillable = [
    'mvp_id',
    'name',
    'description',
    'url'
  ];

  public function mvp(){
    return $this->belongsTo(Mvp::class,'mvp_id');
  }
}
