<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mvp extends Model
{
    protected $table = 'mvp';
    protected $fillable = [
    	'user_id',
    	'name',
    	'type',
    	'description',
    	'slug',
    	'dev_tools',
    	'mvp_link',
      'client_id',
    	'is_approved',
    	'is_available',
      'is_public'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function report(){
        return $this->hasOne(MvpReport::class,'mvp_id');
    }

    public function files(){
      return $this->hasMany(Mvp_files::class,'mvp_id');
    }

    public function features(){
      return $this->hasMany(Mvp_features::class,'mvp_id');
    }
}
