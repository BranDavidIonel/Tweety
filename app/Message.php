<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Message extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    //I check if the message belong to  user authentication
    public function is_user_auth(){
        if($this->user_id==auth()->user()->id){
            return true;
        }else{
            return false;
        }
    }

}
