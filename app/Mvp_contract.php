<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mvp_contract extends Model
{
  protected $table = 'mvp_contract';
  protected $fillable = [
    'mvp_id',
    'developer_id',
    'client_id',
    'client_signature',
    'developer_signature',
    'agreement'
  ];

  public function mvp(){
    return $this->belongsTo(Mvp::class,'mvp_id');
  }
}
