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
            'body' => 'required|max:255'
        ]);
           
        if(Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body']   
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
