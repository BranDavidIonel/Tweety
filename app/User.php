<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Tweet;
use App\Folowable;
class User extends Authenticatable
{
    use Notifiable,Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id','username','avatar','name', 'email', 'password',
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
    //$user->paaword='foobar'
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function getAvatarAttribute($value)
    {
        //return "https://i.pravatar.cc/120?u=" . $this->email;
        return $value ? "images/".$value :"/images/default-avatar.jpeg";
        //return asset($value);
    }
    public function tweets(){
        return $this->hasMany(Tweet::class);

    }
    public function timeline()
    {
       //return Tweet::where('user_id', $this->id)->latest()->get();
        //return Tweet::all();
        //include all pf the user's tweets
        //as welll as the tweets of evryoane
        //they follow
        $friends=$this->follows()->pluck('id');
        return Tweet::whereIn('user_id',$friends)
                ->orWhere('user_id',$this->id)
                ->withLikes()
                ->latest()->get();
    }
    
 public function follow(User $user)
 {
     return $this->follows()->save($user);
 }

 public function follows()
 {
     return $this->belongsToMany(
         User::class,
         'follows',
         'user_id', 
         'following_user_id'
     );
 }
 /*
 in locul la 
 //Route::get('/profiles/{user:name}', 'ProfilesController@show')->name('profile');
 public function getRouteKeyName()
 {
     return 'name';
 }*/
 public function path($append='')
 {
     $path=route('profile',$this->username);

     //return route('profile', $this->name);
     return $append ? "{$path}/{$append}":$path;
 }

}
