<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class ProfilesController extends Controller
{
    public function show(User $user)
    {
        //dd($user);
        return view('profiles.show', compact('user'));
    }
    public function edit(User $user){
        //abort_if($user->isNot(auth()->user()),404);
        $this->authorize('edit',$user);
        return view('profiles.edit',compact('user'));
    }
}
