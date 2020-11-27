<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Tweet extends Model
{
    use Likable;
    protected $guarded = [];
    public function user()
    {
        
        return $this->belongsTo(User::class);
    }
    public function  current_user(){
        return auth()->user();
    }

}
