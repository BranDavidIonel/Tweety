<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
class FollowersNotification extends Component
{
    public $notifications;
    public $users;
    public $user;
    public $username;
    public $avatar;
    public $path;
    
    public function mount(){
        //$this->notifications=User::find(auth()->user()->id)->unreadNotifications;
 
    }
    public function render()
    {
        $this->notifications=User::find(auth()->user()->id)->unreadNotifications;
        return view('livewire.followers-notification',[
            'notifications'=>$this->notifications,
            'username'=>$this->username,
            'avatar'=>$this->avatar,
            'path'=>$this->path,

        ]);
    }
    public function setUser($idUser){       
        $user=User::where('id',$idUser)->firstOrFail();
        $this->username[$idUser]=$user->username;
        $this->avatar[$idUser]=$user->avatar;
        $this->path[$idUser]=$user->path();
        
    }
    public function read($id){
        $notifications=User::find(auth()->user()->id)->unreadNotifications;
        if($id==='0'){
            $notifications->markAsRead();
        }else{
            $notifications->where('id',$id)->markAsRead();
        }
    } 
    
}
