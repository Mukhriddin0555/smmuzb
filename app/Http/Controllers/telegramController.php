<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\TelegramUser;
use App\Models\Veryfication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class telegramController extends Controller
{
    protected $textagree = 'Хурматли мижоз сиз уз мижозларимиз сафиги кушилишингизни илтимос киламиз, бунинг учун сизга уз контактингизни юборишингиз кифоя, бу билансиз Бизнинг дуконимизда болайотган скидкалар хакида хабарлар олиб туришингиз мумки ва кушимча скидкаларга эга болишнгиз мумкин. Асосийси хар ой утказиладиган ютукли ойинларда катнашиш имкониятига эга боласиз.';
    protected $button1 = 'Юбориш';
    protected $button2 = 'Рози эмасман';
    protected $menu1 = [];
    protected $menu2 = [];
    public function saveContact($contact, $telegram){
        $number = $contact['phone_number'];
        $first_name = $contact['first_name'];
        $last_name = $contact['last_name'];
        $user_id = $contact['user_id'];

    }
    public function menu1(){
        
    }
    public function menu2(){
        
    }
    public function sendContactVerify($identfiedclient, $telegram){
            $chat_id = $identfiedclient->telegram_id;
            $text = 'Хурматли мижоз хуш келибсиз, телефон ракамингизни тастиклашингизни илтимос киламиз. Ушбу ракам сизга тегишлими?';
            $button = [
                    'keyboard' =>
                    [
                        [
                            [
                                'text' => 'Ха албатта',
                            ],
                            [
                                'text' => 'Йук бошка',
                            ]
                        ]
                    ],
                    'one_time_keyboard' => true,
                ];
            $message = $telegram->sendButtons($chat_id, $text, $button);
            $message = json_decode($message);
            $verify = new Veryfication();
            $verify->message_id = $message['message']['message_id'];
            $verify->chat_id = $chat_id;
            $verify->save();
    }


    public function sendButtonsForContact($chat_id, $telegram, $replymessage = 1, $text = 1){
        $identfiedclient = TelegramUser::where('telegram_id', $chat_id)->first();

        if($identfiedclient && $replymessage == 1 && $text == 1){
            return $this->sendContactVerify($identfiedclient, $telegram);
        }
        if($identfiedclient && $replymessage != 1 && $text != 1){
            return $this->editContactVerify($identfiedclient, $telegram, $replymessage, $text);
        }

    }
    public function editContactVerify($chat_id, $telegram, $replymessage, $text){
        $yes = 'Ха албатта';
        $no = 'Йук бошка';
        $identfiedclient = TelegramUser::where('telegram_id', $chat_id)->first();
        $reply_message = Veryfication::where('message_id', $chat_id)->first();

        if($text == $yes && $reply_message){
            return $this->menu1($chat_id, $telegram);
            $reply_message->delete();
        }
        if($text == $no && $reply_message){
            return $this->sendRequestContact($chat_id, $telegram);
            $identfiedclient->delete();
            $reply_message->delete();
        }

    }
    public function sendRequestContact($chat_id, $telegram){
        $button = [
            'keyboard' =>
            [
                [
                    [
                        'text' => $this->button1,
                        'request_contact' => true,
                    ]
                    
                ]
                [
                    [
                        'text' => $this->button2,
                        'request_contact' => false,
                    ]
                ]
            ],
            'one_time_keyboard' => true,
        ];
    return $telegram->sendButtons($chat_id, $this->textagree, $button);
        
    }
    public function getmessage(Request $request, Telegram $telegram)
    {
        
        $contact = $request['message']['contact'];
        
        $chat_id = $request['message']['chat']['id'];
        $text = $request['message']['text'];
        
        $from_id = $request['message']['from']['id'];
        
        $first_name = $request['message']['from']['first_name'];
        $last_name = $request['message']['from']['last_name'];
        $username = $request['message']['from']['username'];
        $replymessage = $request['message']['reply_to_message']['message_id'];
        if($text == '/start'){
            return $this->sendButtonsForContact($chat_id, $telegram);
        }
        if($text == 'Ха албатта' || $text == 'Йук бошка'){
            return $this->sendButtonsForContact($chat_id, $telegram, $replymessage, $text);
        }
        
        //$chat_id = 34764210;
        //$message = '+998914885559';
        /*if($text == 'test'){
            $chat_id = 34764210;
            $text = 'test';
            $button = [
                    'keyboard' =>
                    [
                        [
                            [
                                'text' => 'Отправить свой контакт',
                                'request_contact' => true,
                            ]
                        ]
                    ],
                    'one_time_keyboard' => true,
                ];
            return $telegram->sendButtons($chat_id, $text, $button);
        }else{
            
        }*/
        //Log::debug($request['message']['chat']['id']);
    }
    public function sendmessage(Telegram $telegram)
        {
            $chat_id = 34764210;
            $text = 'test';
            $button = [
                    'keyboard' =>
                    [
                        [
                            [
                                'text' => 'Отправить свой контакт',
                                'request_contact' => true,
                            ]
                        ]
                    ],
                    'one_time_keyboard' => true,
                ];
            return $telegram->sendButtons($chat_id, $text, $button);
            
    }
}
