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
    public function path_file($file){
        return asset('storage/'.$file);

    }
     //I whant to check if is an image(I check the extension of file), then I show image 
     public function checkFile($filename){
        $ext = substr($filename, strrpos($filename, '.') + 1);
        if($ext=="jpg"||$ext=="png"||$ext=="svg"||$ext=="jpeg"){
            return true;
        }else{
            return false;
        }
    }

}
