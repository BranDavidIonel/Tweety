<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
class SearchUsers extends Component
{
    public $search='';
    public function render()
    {
         $users=null;
         if(empty($this->search)){
            $users=User::paginate(4);
        }else{
            $users= User::where('username',$this->search)->paginate(1);
        }  
        
        return view('livewire.search-users',
        compact('users')
        );
    }
}
