<?php

namespace App\Helpers;

use App\Models\TelegramUser;

class TgUser {

    public $userfirst;

    public $contact;
    public $phone_number;
    
    public $message_id;
    public $text;
    public $chat_id;

    public $user_id;
    public $first_name;
    public $last_name;
    public $user_name;
    public $language_code;

    public $chattype;
    public $chattitle;



    public $chatrole;  //boolean all_members_are_administrators

    public $sendmessageid; //result send message /id
    public $resultok;  //boolean
    
    public $replymessage;

    public function __construct($request)
    {
        $message = $request['message'] ?? false;
        $messagefrom = $message['from'] ?? false;
        $chat = $message['chat'];
        $this->contact = $message['contact'] ?? false;
        $this->text = $message['text'] ?? false;
        
        $this->message_id = $message['message_id'];

        $this->user_id = $messagefrom['id'] ?? false;
        $this->first_name = $messagefrom['first_name'] ?? 'net';
        $this->last_name = $messagefrom['last_name'] ?? 'net';
        $this->user_name = $messagefrom['username'] ?? 'net';
        $this->language_code = $messagefrom['language_code'] ?? false;

        $this->phone_number = $this->contact['phone_number'] ?? false;

        $this->chat_id = $chat['id'] ?? false;

        $this->chattitle = $chat['title'] ?? false;
        $this->chattype = $chat['type'] ?? false;

        $this->userfirst = TelegramUser::where('telegram_id', $this->user_id)->first() ?? false;
        if($this->userfirst == false){$this->userfirst = $this->newuser();}
        if($this->contact){$this->userfirst = $this->newuser($this->userfirst);}

    }
    public function newuser($usertg = null){
            $user = $usertg ?? new TelegramUser();
            $user->number = $this->phone_number ? strval($this->phone_number) : strval($this->phone_number) . strval(mt_srand(10));
            $user->number2 = $this->phone_number ? strval($this->phone_number) : strval($this->phone_number) . strval(mt_srand(10));
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->telegram_id = $this->user_id;
            $user->client_status_id = 1;
            $user->discount_number = 1;
            $user->save();
            $user->discount_number = random_int(1000, 9999) . $user->id;
            $user->save();
            return $user;
    }
}
