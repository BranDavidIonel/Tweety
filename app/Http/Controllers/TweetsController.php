<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Tweet;
class TweetsController extends Controller
{
    private $path='attash_tweet/';
    public function index()
    {
       //dd(  auth()->user()->timeline());
       //exit();
     
        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
        ]);
    }
    public function store()
    {
        $attributes = request()->validate([
            'body' => 'required|max:400'
        ]);
       

        if (request('files')) {
            $str_files='';
            $countFiles=count(request('files'));
            for($i=0;$i<$countFiles;$i++){
            
            $files_name=date('dmy_H_s_i').'_'.$i;
            $files=request('files')[$i];
            $ext=strtolower($files->getClientOriginalExtension());
            $files_full_name=$files_name.'.'.$ext;
            $success=$files->move($this->path,$files_full_name);
            $str_files=$str_files.$files_full_name.',';
            }
            $str_files=mb_substr($str_files,0,-1);
            //$attributes['name_file'] = request('name_file')->store('attash_file');
            $attributes['name_file']=$str_files;
            //dd($attributes['name_file']);
        }else{
            $attributes['name_file']='';
        }   
        if(Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body'],
            'name_file'=>$attributes['name_file']   
        ])){
            Session::flash('success','You published a tweet successfully!') ;
        }

        return redirect('/tweets');
    }
    public function destroy(Tweet $tweet){
       
        if($tweet->delete_tweet(auth()->user())){
            //delete files
            $files_split=explode(',', $tweet->name_file);
            foreach($files_split as $file){
            if($file){
                unlink($this->path.$file);
                }
            }
            Session::flash('success','The tweet '.'"'.$tweet->body.'"'.'it was deleted !') ;
        }else{
            Session::flash('success','You do not have permission to delete '.'"'.$tweet->body.'"'.'!');
        }
       return  back();
    }
}
