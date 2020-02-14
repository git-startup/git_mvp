<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mvp_gallery extends Model
{
    protected $table = 'mvp_gallery';
    protected $fillable = [
      'mvp_id',
      'url'
    ];

    public function mvp(){
      return $this->belongsTo(Mvp::class,'mvp_id');
    }
}
