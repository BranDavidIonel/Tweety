<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class FollowersNotificationController extends Controller
{
    public function show($id){
        return view('notification.followers');
    }
   
}
