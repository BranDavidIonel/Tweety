<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use Livewire\Component;
use App\User;
class SearchUsers extends Component
{
    use WithPagination;
    public $search='';
    public function render()
    {
         $users=User::where('username','like', '%'.$this->search.'%')->paginate(2);
         /*
         if(empty($this->search)){
            $users=User::paginate(4);
        }else{
            $users= User::where('username',$this->search)->paginate(1);
        } */ 
        
        return view('livewire.search-users',
        compact('users')
        );
    }
}
