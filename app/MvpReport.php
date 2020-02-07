<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MvpReport extends Model
{
    protected $table = 'mvp_report';
    protected $fillable = [
    	'user_id',
    	'mvp_id',
    	'downloads',
    	'views',
    	'rating'
    ];

    public function mvp(){
        return $this->belongsTo(Mvp::class,'mvp_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
