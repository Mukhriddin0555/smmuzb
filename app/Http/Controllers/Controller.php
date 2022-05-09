<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function register($id){
        $user = TelegramUser::find($id);
        return view('register', ['user' => $user]);
        //dd($user);

    }
    public function registered($id){

    }
}
