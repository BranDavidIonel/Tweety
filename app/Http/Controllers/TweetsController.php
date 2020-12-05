<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Tweet;
class TweetsController extends Controller
{
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
            $upload_path='attash_tweet/';
            $files_name=date('dmy_H_s_i');
            $files=request('files')[0];
            $ext=strtolower($files->getClientOriginalExtension());
            $files_full_name=$files_name.'.'.$ext;
            $success=$files->move($upload_path,$files_full_name);
            //$attributes['name_file'] = request('name_file')->store('attash_file');
            $attributes['name_file']=$files_full_name;
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
            Session::flash('success','The tweet '.'"'.$tweet->body.'"'.'it was deleted !') ;
        }else{
            Session::flash('success','You do not have permission to delete '.'"'.$tweet->body.'"'.'!');
        }
       return  back();
    }
}
