<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\File;
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
        return asset('storage/message/'.$file);

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
    public function scopeWithFiles(Builder $query)
    {
        $query->leftJoinSub(
            "SELECT  id_parent,GROUP_CONCAT(DISTINCT name_file SEPARATOR ',') as name_files 
            FROM files 
            WHERE type_parent=2 
            GROUP BY id_parent",
            'files',
            'files.id_parent',
            'messages.id'
        );
    }

    public function getFiles(){
        return $this->where('id','=',$this->id)
        ->withFiles()->first();
    }

}
