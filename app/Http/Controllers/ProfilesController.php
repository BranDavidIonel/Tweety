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
}
