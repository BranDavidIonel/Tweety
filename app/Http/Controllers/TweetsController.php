<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Session;
use App\Tweet;
use App\File;
class TweetsController extends Controller
{
    private $path='tweet_files/';
    public function index()
    {
       //dd(  auth()->user()->timeline());
       //exit();
     
        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
        ]);
    }
    public function store()
    {
        $data_file=[
            'id_parent'=>0,
            'type_parent'=>1,
            'user_id'=>auth()->user()->id,
            'name_file'=>''
        ];
        $attributes = request()->validate([
            'body' => 'required|max:400'
        ]);
        $tweet=Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body']]);
        if($tweet){
            Session::flash('success','You published a tweet successfully!') ;
        }

        if (request('files')) {
            //$str_files='';
            $countFiles=count(request('files'));
            for($i=0;$i<$countFiles;$i++){
            
            $files_name=date('dmy_H_s_i').'_'.$i;
            $files=request('files')[$i];
            $ext=strtolower($files->getClientOriginalExtension());
            $files_full_name=$files_name.'.'.$ext;
            //$success=$files->move($this->path,$files_full_name);
            $success=$files->storeAs($this->path,$files_full_name);
            $data_file['id_parent']=$tweet->id;
            $data_file['name_file']=$files_full_name;
            File::create($data_file);
            }
            //$str_files=mb_substr($str_files,0,-1);
            //$attributes['name_file'] = request('name_file')->store('attash_file');
            //$attributes['name_file']=$str_files;
            //dd($attributes['name_file']);
        }else{
           // $attributes['name_file']='';
        }   
        

        return redirect('/tweets');
    }
    public function destroy(Tweet $tweet){
       
        if($tweet->delete_tweet(auth()->user())){
            //delete files
            $files_split=explode(',', $tweet->name_file);
            foreach($files_split as $file){
            if($file){
                //unlink(storage_path('app/public/'.$this->path.$file));
                Storage::delete($this->path.$file);
                }
            }
            Session::flash('success','The tweet '.'"'.$tweet->body.'"'.'it was deleted !') ;
        }else{
            Session::flash('success','You do not have permission to delete '.'"'.$tweet->body.'"'.'!');
        }
       return  back();
    }
}
