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
    	'how_to_use_file',
    	'mvp_file',
        'price',
    	'image_one',
    	'image_two',
    	'image_three',
    	'is_approved',
    	'is_available'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function report(){
        return $this->hasOne(MvpReport::class,'mvp_id');
    }
}
