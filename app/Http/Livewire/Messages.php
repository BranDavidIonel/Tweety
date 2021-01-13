<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\Message;
class Messages extends Component
{
    public $messages;
    public $message_send;
    public $id_user;
    public function mount(){
        $user_id_first=User::where('id','<>', auth()->user()->id)->first();
        //dd($user_id_first->id);
        $this->id_user=$user_id_first->id;
    }
    public function render()
    {
        $users=User::where('id','<>', auth()->user()->id)->paginate(2);
      
        $this->messages=Message::
        where('user_id','=',auth()->user()->id)
        ->Where('send_user_id','=',$this->id_user)
        ->orWhere('send_user_id','=',auth()->user()->id)
        ->where('user_id','=',$this->id_user)
        ->get()->all();
        //dd($messages);
        return view('livewire.messages',compact('users','messages'));
    }
    public function delete($id_message){
        $message=Message::find($id_message);
        $message->delete();

    }
    /*
    public function update($field){
        //dd($field);
        $this->validateOnly($filed,['message_send' => 'required|min:7']);

    }
    */
    public function setMessagesUserId($id_user){
        $this->id_user=$id_user;
    }
    public function submit()
    {
       // dd($this->message_send);
        $this->validate([
            'message_send' => 'required|min:1'
        ]);
        $data=[
            'user_id'=>auth()->user()->id,
            'send_user_id'=>$this->id_user,
            'message' => $this->message_send
        ];
        Message::create($data);
        $this->resetValues();
  
    }
    public function resetValues(){
        $this->message_send="";
    }
}
