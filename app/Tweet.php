<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Tweet extends Model
{
    use Likable;
    protected $guarded = [];
    public function user()
    {
        
        return $this->belongsTo(User::class);
    }
    public function  current_user(){
        return auth()->user();
    }
    // I delete tweet that belong  the current user\
    public function delete_tweet($user){
        if($this->user_id==$user->id){
            $tweetDel=$this::find($this->id);
            $tweetDel->delete();
            return true;
        }else{
            return false;
        }
    }
    //I whant to check if is an image(I check the extension of file), then I show image 
    public function checkFile($filename){
        $ext = substr($filename, strrpos($filename, '.') + 1);
        if($ext=="jpg"||$ext=="png"||$ext=="svg"){
            return true;
        }else{
            return false;
        }
    }
    



}
