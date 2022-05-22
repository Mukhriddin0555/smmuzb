<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Telegram {

    protected $http;
    protected $bot;
    const url = 'https://api.telegram.org/bot';

    public function __construct(Http $http, $token)
    {
        $this->http = $http;
        $this->bot = [ 1 => $token[0]->token, 2 => $token[1]->token];
    }

    public function sendMessage($chat_id, $message, $token = 1){
      return  $this->http::post(self::url.$this->bot[$token].'/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
        ]);
    }
    public function sendMessageHtml($chat_id, $message, $token = 1){
        return  $this->http::post(self::url.$this->bot[$token].'/sendMessage', [
              'chat_id' => $chat_id,
              'text' => $message,
              'parse_mode' => 'html'
          ]);
      }
    public function sendContact($chat_id, $phone, $name, $token = 1){
        return  $this->http::post(self::url.$this->bot[$token].'/sendContact', [
              'chat_id' => $chat_id,
              'phone_number' => $phone,
              'first_name' => $name,
              'parse_mode' => 'html'
          ]);
      }
    public function replyMessage($chat_id, $message, $message_id,$token = 1){
        return  $this->http::post(self::url.$this->bot[$token].'/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_to_message_id' => $message_id
        ]);
    }


    public function editMessage($chat_id, $message, $message_id, $token = 1){
        return  $this->http::post(self::url.$this->bot[$token].'/editMessageText', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'message_id' => $message_id
        ]);
    }

    public function sendDocument($chat_id, $file, $reply_id = null, $token = 1){
      return  $this->http::attach('document', Storage::get('/public/'.$file), 'document.png')
            ->post(self::url.$this->bot[$token].'/sendDocument', [
            'chat_id' => $chat_id,
            'reply_to_message_id' => $reply_id
        ]);
    }

    public function sendButtons($chat_id, $message, $button, $token = 1){
        return  $this->http::post(self::url.$this->bot[$token].'/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_markup' => $button
        ]);
    }

    public function editButtons($chat_id, $message, $button, $message_id,$token = 1){
        return  $this->http::post(self::url.$this->bot[$token].'/editMessageText', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_markup' => $button,
            'message_id' => $message_id,
        ]);
    }
}