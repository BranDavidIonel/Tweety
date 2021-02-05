<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\Message;
use App\File;
use Livewire\WithFileUploads;
//use Livewire\WithPagination;
class Messages extends Component
{
    use WithFileUploads;
    //use WithPagination;
    private $path='message/';
    public $messages;
    public $message_send;
    public $id_user;
    public $files;
    public function mount(){
        $user_id_first=User::where('id','<>', auth()->user()->id)->first();
        //dd($user_id_first->id);
        $this->id_user=isset($user_id_first->id)?$user_id_first->id:0 ;
    }
    public function render()
    {
        $users=User::where('id','<>', auth()->user()->id)->paginate(2);
      
        $this->messages=Message::
        where('user_id','=',auth()->user()->id)
        ->Where('send_user_id','=',$this->id_user)
        ->orWhere('send_user_id','=',auth()->user()->id)
        ->where('user_id','=',$this->id_user)
        ->orderBy('created_at', 'desc')->get()->all();
        //dd($this->messages[0]->getFiles()->name_files);
        //var_dump($this->messages[0]->getFiles());
        //dd($this->messages[0]->getFiles()[0]["attributes"]["name_file"]);
        return view('livewire.messages',compact('users','messages'));
    }
    public function delete($id_message){
        $message=Message::find($id_message);
        $files=File::where('id_parent','=',$message->id)->where('type_parent','=',2);
        $files->delete(); 
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
        $data_file=[
            'id_parent'=>0,
            'type_parent'=>2,
            'user_id'=>auth()->user()->id,
            'name_file'=>''
        ];
        
        $message=Message::create($data);
        if ($this->files) {
            //$str_files='';
            $countFiles=count($this->files);
            for($i=0;$i<$countFiles;$i++){
            
            $file_name=date('dmy_H_s_i').'_'.$i;
            $file=$this->files[$i];
            $ext=strtolower($file->getClientOriginalExtension());
            $file_full_name=$file_name.'.'.$ext;
            $success=$file->storeAs($this->path,$file_full_name);
            $data_file['id_parent']=$message->id;
            $data_file['name_file']=$file_full_name;
            //insert the name for file
            File::create($data_file);
            }
            
        }
        $this->resetValues();
  
    }
    public function resetValues(){
        $this->message_send="";
    }
}
