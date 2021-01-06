<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\Message;
class Messages extends Component
{
    public $messages;
    public $id_user;
    public function mount(){
        $user_id_first=User::where('id','<>', auth()->user()->id)->first();
        //dd($user_id_first->id);
        $this->id_user=$user_id_first->id;
    }
    public function render()
    {
        $users=User::where('id','<>', auth()->user()->id)->paginate(2);
      
        $this->messages=Message::where('send_user_id','=',$this->id_user)->get()->all();
        //dd($messages);
        return view('livewire.messages',compact('users','messages'));
    }
    public function setMessagesUserId($id_user){
        //dd($id_user);
        $this->id_user=$id_user;
    }
}
