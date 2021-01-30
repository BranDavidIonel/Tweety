<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\Message;
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
        ->orderBy('created_at', 'desc')->get()->all();
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
        if ($this->files) {
            $str_files='';
            $countFiles=count($this->files);
            for($i=0;$i<$countFiles;$i++){
            
            $file_name=date('dmy_H_s_i').'_'.$i;
            $file=$this->files[$i];
            $ext=strtolower($file->getClientOriginalExtension());
            $file_full_name=$file_name.'.'.$ext;
            $success=$file->storeAs($this->path,$file_full_name);
            $str_files=$str_files.$file_full_name.',';
            }
            $str_files=mb_substr($str_files,0,-1);
            //$attributes['name_file'] = request('name_file')->store('attash_file');
            $data['name_file']=$str_files;
            //dd($attributes['name_file']);
        }else{
            $data['name_file']='';
        } 
        Message::create($data);
        $this->resetValues();
  
    }
    public function resetValues(){
        $this->message_send="";
    }
}
