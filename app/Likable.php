<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

trait Likable
{
    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function isLikedBy(User $user)
    {
        
        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    public function isDislikedBy(User $user)
    {
        
        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', false)
            ->count();
            
    }
    public function users(){
        return $this->belongsToMany(User::class,
                                    'likes'
                                    );
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function like($user = null, $liked = true)
    {

        if( $this->isLikedBy(auth()->user())&&($liked==true)){
            //var_dump(auth()->user());
            //dd($this->users());
            $this->users()->detach(auth()->user());
            
        }else if($this->isDislikedBy(auth()->user())&&($liked==false)){
            $this->users()->detach(auth()->user());
        }else{
            $this->likes()->updateOrCreate(
                [
                    'user_id' => $user ? $user->id : auth()->id()
                ],
                [
                    'liked' => $liked,
                ]
            );
        }
       
    }
    
}