<?php

namespace App;

use App\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable; 

    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'phone',
        'gender', 
        'location',
        'type',
        'image',
        'description',
        'skills',
        'is_disable'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     // to get the username 
    public function getUsername(){
        return $this->username;
    }

    // function to get the user fullname
    public function getname(){
        return $this->name;
    }

    // function to get the user phone
    public function getPhone(){
        return $this->phone;
    }

    // function to get user avatar
    public function getAvatar(){
        return $this->user_image;
    }

    // function to get user gender
    public function getGender(){
        return $this->gender;
    }

    // for user profile model
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    // for articals table
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // for tickets table
    public function tickets()
    {
        return $this->hasMany(Tickets::class);
    }

    // so user can make a new status
    public function statuses(){
        return $this->hasMany(Status::class,'user_id');  
    }
    
    //for mvp table
    public function mvps(){
        return $this->hasMany(Mvp::class,'user_id');  
    }

    // for mvp report table
    public function report(){
        return $this->hasMany(MvpReport::class,'user_id');  
    }
    
    // for massanger table
    public function Messenger(){
        return $this->hasMany(Message::class,'from');  
    }
    
    // this method for orders table
    public function orders(){
        return $this->hasMany('gitstartup\Orders','user_id');
    }   
 
    // for like model
    public function likes(){
        return $this->hasMany(Like::class,'user_id');
    }
    // to cheack if the user already like this status
    public function hasLikedStatus(Status $status){
        return (bool) $status->likes()->where('user_id',$this->id)->count();
    }

    // for work table
    public function workersOfMine(){ 
        return $this->belongsToMany(User::class,'work_list','user_id','worker_id');
    }
    
    public function workerOf(){
        // test this out (user_id vs worker_id)
        return $this->belongsToMany(User::class,'work_list','worker_id','user_id');
    }
    
    public function workers(){
        return $this->workersOfMine()->wherePivot('accepted',true)->get()->merge($this->workerOf()->wherePivot('accepted',true)->get());
    }
    
    public function workRequest(){
        return $this->workersOfMine()->wherePivot('accepted',false)->get();
    }
    
    public function workRequestPending(){
        return $this->workerOf()->wherePivot('accepted',false)->get();
    }
    
    public function hasWorkRequestPending(User $user){
        return (bool) $this->workRequestPending()->where('id',$user->id)->count();
    }
    
    public function hasWorkRequestRecived(User $user){
        return (bool) $this->workRequest()->where('id',$user->id)->count();
    }
    
    public function addWorker(User $user){
        $this->workerOf()->attach($user->id);
    }
    
    public function deleteWorker(User $user){
        $this->workerOf()->detach($user->id);
        $this->workersOfMine()->detach($user->id);
    }
    
    public function acceptWorkRequest(User $user){
        $this->workRequest()->where('id',$user->id)->first()->pivot->update([
            'accepted' => true, 
        ]);
    }
    
    public function isWorkWith(User $user){
        return (bool) $this->workers()->where('id',$user->id)->count();
    }

}
