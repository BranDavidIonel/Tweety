<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class FollowersNotificationController extends Controller
{
    public function show($id){
       $notifications=auth()->user()::find($id)->unreadNotifications;
        //$notifications=tap(auth()->user()::find($id)->unreadNotifications)->markAsRead();
        //if ($notification->type == "App\Notifications\Followers")
        //$notification->read_at
       $users_id=array();
       for($i=0;$i<count($notifications);$i++){
          array_push( $users_id,$notifications[$i]->data["user_id"]);
       }
        $users=User::whereIn('id',$users_id)->get();
        //dd($users);
        return view('notification.followers',[
        'users'=>$users
        ]);
    }
}
