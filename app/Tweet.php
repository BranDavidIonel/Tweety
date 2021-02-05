<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
            //delete from table files
            $files=File::where('id_parent','=',$tweetDel->id)->where('type_parent','=',1);
            $files->delete();
            $tweetDel->delete();
            return true;
        }else{
            return false;
        }
    }
    public function path_file($file){
        return asset('storage/tweet_files/'.$file);

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
            WHERE type_parent=1 
            GROUP BY id_parent",
            'files',
            'files.id_parent',
            'tweets.id'
        );
    }

    public function getFiles(){
        return $this->where('id','=',$this->id)
                    ->withFiles()->first();
    }



}
