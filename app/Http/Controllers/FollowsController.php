<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
class FollowsController extends Controller
{
    public function store(User $user)
    {
        auth()->user()->toggleFollow($user)['attached']? 
        Session::flash('success','Your added  '.'"'.$user->username.'"'.'to your list of followers! ') : 
        Session::flash('success','Your deleted  '.'"'.$user->username.'"'. 'to your list of followers! ')
        ;
       

        return back();
    }
}
