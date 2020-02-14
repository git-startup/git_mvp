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
    	'is_approved',
    	'is_available'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function report(){
        return $this->hasOne(MvpReport::class,'mvp_id');
    }

    public function gallery(){
      return $this->hasMany(Mvp_gallery::class,'mvp_id');
    }
}
