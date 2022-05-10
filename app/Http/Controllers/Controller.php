<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    

    public function register($id){
        
        $user = substr($id, 3, -3);
        $user = TelegramUser::find($user);
        return view('register', ['user' => $user]);

    }
    public function registered($id, Request $req){

        $req->validate([
            'last_name' => ['required'],
            'first_name' => ['required'],
        ]);
        $user = substr($id, 3, -3);
        $user = TelegramUser::find($user);
        $user->original_last_name = $req->last_name;
        $user->original_first_name = $req->first_name;
        if(isset($req->number)){$user->number2 = $req->number;}
        if($user->save()){
            return redirect()->route('sucsess');
        }
        

    }
    public function sucsess(){
        
        return view('sucsess');

    }
}
