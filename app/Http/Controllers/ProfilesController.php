<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
class ProfilesController extends Controller
{
    public function show(User $user)
    {
        //dd($user);
        return view('profiles.show', compact('user'));
    }
    public function edit(User $user){
        //abort_if($user->isNot(auth()->user()),404);
        $this->authorize('edit',$user);
        return view('profiles.edit',compact('user'));
    }
    public function update(User $user)
    {
       //dd(request('avatar'));
        $attributes = request()->validate([
            'username' => [
                'string',
                'required',
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($user),
            ],
            'name' => ['string', 'required', 'max:255'],
            'avatar' => ['image'],
            'email' => [
                'string',
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user),
            ],
            'password' => [
                'string',
                'required',
                'min:4',
                'max:255',
                'confirmed',
            ],
        ]);

        if (request('avatar')) {
            $upload_path='images/';
            $image_name=date('dmy_H_s_i');
            $image=request('avatar');
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $success=$image->move($upload_path,$image_full_name);
            //$attributes['avatar'] = request('avatar')->store('avatars');
            $attributes['avatar']=$image_full_name;
           // dd($attributes['avatar']);
        }

        $user->update($attributes);

        return redirect($user->path());
    }
}
