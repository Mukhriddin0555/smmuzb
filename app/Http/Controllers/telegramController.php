<?php

namespace App\Http\Controllers;

use App\Models\ForBot;
use App\Models\BotToken;
use App\Models\Question;
use App\Helpers\Telegram;
use App\Models\TelegramUser;
use Illuminate\Http\Request;
use App\Models\CallBackQuestion;
use Illuminate\Support\Facades\Log;

class telegramController extends Controller
{
    protected $textagree = "
    Ассалому алейкум!\n
\u{1F91D}Сизни уз мижозларимиз сафига кушилишингизни илтимос киламиз!\n
\u{1F4F1}Бунинг учун бизга уз контактингизни юборишингиз кифоя!\n 
\u{1F4A5}Бу билан сиз Бизнинг дўконимизда бўлаётган\n 
\u{231B}Чегирмалар ва янгиликлар хақида
    доим хабардор бўлиб турасиз.\n
\u{1F525}Асосийси сиз доимий 2 %ли черирмага эга бўласиз\n
\u{1F929}Ундан хам зўри хар ой ўтказиладиган ютуқли ўйинларда қатнашиш имкониятига эга бўласиз.
    ";
    protected $button1 = "\u{2705}Ха!";
    protected $button2 = "\u{274C}Йок!";
    protected $button3 = "\u{2705}Ха";
    protected $button4 = "\u{274C}Йук";
    protected $textveryficated = "\u{1F91D}Cизга хизмат курсатишдан мамнунмиз!";
    protected $vt2 = " Ботимизга хуш келибсиз!\n
    Юкорида курсатилган маълумотлар сизга тегишли булса 
    <b>ХА</b> тугмасини босинг!";
    protected $menubuttonreg = "\u{1F525}Чегирма олиш учун Руйхатдан утиш";
    protected $menubutton1 = "\u{1F3AB}Чегирма учун берилган ракам";
    protected $menubutton2 = 'Янги скидкалар хакида';
    protected $menubutton3 = 'Статус';
    protected $menubutton4 = 'Харидларим';
    protected $menubutton5 = "\u{1F4DE}Биз билан богланиш";
    protected $menubutton6 = "\u{1F3E2}Бизнинг Манзил";	
    protected $menu2button1 = 'Контакт юбориш';
    protected $menu2button2 = 'Манзилимиз';
    protected $menu2button3 = 'Янгиликлар';
    protected $menubutton66 = "Бизнинг Манзил:\n\u{1F3E2} Андижон ш. Бобуршох кучаси 1-уй";
    protected $menubutton55 = "Биз билан богланиш:\n \u{1F64E}\u{200D}\u{2642}\u{FE0F}Админ: @smmuzb3737\n \u{1F4DE}Тел: +998938033737";

    public function saveContact($contact, $token){
        $number = $contact['phone_number'];
        $first_name = 'Comp';
        $last_name = 'Biznes';
        $user_id = $contact['user_id'];
        $user = TelegramUser::where('telegram_id', $user_id)->first();
        if(!$user){
            $user = new TelegramUser();
            $user->number = strval($number);
            $user->number2 = strval($number);
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->telegram_id = $user_id;
            $user->client_status_id = 1;
            $user->discount_number = 1;
            $user->save();
            $user->discount_number = random_int(1000, 9999) . $user->id;
            $user->save();
            ForBot::firstOrCreate(['telegram_user_id' => $user->id, 'bot_token_id' => $token]);
            return $user;
        }else{
            $user->number = strval($number);
            $user->number2 = strval($number);
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->telegram_id = $user_id;
            $user->client_status_id = 1;
            $user->save();
            ForBot::firstOrCreate(['telegram_user_id' => $user->id, 'bot_token_id' => $token]);
            return $user;
        }
        

    }
    public function menu1($telegram_id, $telegram, $token){
        $button = 0;
        if(TelegramUser::where('telegram_id', $telegram_id)->first()->active == 0){
            $button = ['text' => $this->menubuttonreg];
        }else{
            $button = ['text' => $this->menubutton1];
        ;}
        $menu1 = [
            'keyboard' =>
                [
                    [
                        
                        $button
                        
                    ],
                    [
                        [
                            'text' => $this->menubutton5
                        ]
                    ],
                    [
                        [
                            'text' => $this->menubutton6
                        ]
                    ],
                ],
                'resize_keyboard' => true,
        ];
        return $telegram->sendButtons($telegram_id, $this->textveryficated, $menu1, $token);
    }
    public function menu2($telegram_id, $telegram, $token){
        $menu2 = [
            'keyboard' =>
                [
                    [
                        [
                            'text' => $this->menu2button1,
                            'request_contact' => true

                        ]
                    ],
                    [
                        [
                            'text' => $this->menubutton5
                        ]
                    ],
                    [
                        [
                            'text' => $this->menubutton6
                        ]
                    ],
                ],
                'resize_keyboard' => true,
                
        ];
        return $telegram->sendButtons($telegram_id, $this->textagree, $menu2, $token);
    }
    public function sendContactVerify($chat_id, $telegram, $token){
            $user = TelegramUser::where('telegram_id', $chat_id)->first();
            $text = $user->original_last_name . "\n". 
                    $user->original_first_name . "\n".
                    $user->number2 . "\n".
                    BotToken::find($token)->bot_name . $this->vt2;
            $button = [
                    'keyboard' =>
                    [
                        [
                            [
                                'text' => $this->button3,
                            ],
                            [
                                'text' => $this->button4,
                            ],
                        ],
                    ],
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                ];
            return $telegram->sendButtons($chat_id, $text, $button, $token);
            //Log::debug($message);

    }


    public function sendButtonsForContact($chat_id, $telegram, $replymessage = 1, $text = 1, $token){
        $identfiedclient = TelegramUser::where('telegram_id', $chat_id)->first();

        if($identfiedclient && $replymessage == 1 && $text == 1){
            return $this->sendContactVerify($chat_id, $telegram, $token);
        }
        if($identfiedclient && $replymessage != 1 && $text != 1){
            return $this->editContactVerify($chat_id, $telegram, $replymessage, $text, $token);
        }
        if(!$identfiedclient){
            return $this->sendRequestContact($chat_id, $telegram, $token);
        }

    }
    public function editContactVerify($chat_id, $telegram, $replymessage, $text, $token){
        $yes = $this->button3;
        $no = $this->button4;
        $identfiedclient = TelegramUser::where('telegram_id', $chat_id)->first();
        if($text == $yes){
            return $this->menu1($chat_id, $telegram, $token);
            
        }
        if($text == $no){
            $identfiedclient->active = 0;
            $identfiedclient->save();
            return $this->sendRequestContact($chat_id, $telegram, $token);
        }

    }
    public function sendRequestContact($chat_id, $telegram, $token){
        $button = [
            'keyboard' =>
            [
                [
                    [
                        'text' => $this->button1,
                        'request_contact' => true,
                    ],
                    [
                        'text' => $this->button2,
                        'request_contact' => false,
                    ],
                ],
            ],
            'one_time_keyboard' => true,
            'resize_keyboard' => true,
        ];
            return $telegram->sendButtons($chat_id, $this->textagree, $button, $token);
    }

    public function sendmenubutton1($chat_id, $telegram, $token){
        $user = TelegramUser::where('telegram_id', $chat_id)->first();
        if($user->active == 0){
            return $telegram->sendmessage($chat_id, 'Чегирма учун ракамни колга киритиш учун руйхатдан утишингиз керак болади', $token);
            //$telegram->sendmessage($chat_id, 'Чегирма учун ракамни колга киритиш учун ушбу хаволага утиб исм шарифингизни бизга юборинг:<br>https://smmuzb.uz/contact/updated/'. random_int(100, 999) . $user->id . random_int(100, 999));
        }
        if($user->active != 0){
            return $telegram->sendmessage($chat_id, "Сизга берилган чегирма раками:\n     " . $user->discount_number, $token);
        }
    }

    public function getmessage(Request $request, Telegram $telegram, $token = 1)
    {
        //Log::debug($request);

        $contact = false;
        $replymessage = false;
        $text = false;
        $chat_id = false;
        $from_id = false;
        $first_name = 'comp';
        $last_name = 'biznes';
        $username = 'mijoz';
        $replymessage = false;
        if(isset($request['message']['contact'])){
            $contact = $request['message']['contact'];
        }
        if(isset($request['message']['text'])){
            $text = $request['message']['text'];
        }
        if(isset($request['message']['chat']['id'])){
            $chat_id = $request['message']['chat']['id'];
        }
        if(isset($request['message']['from']['id'])){
            $from_id = $request['message']['from']['id'];
        }
        if(isset($request['message']['from']['first_name'])){
            $first_name = $request['message']['from']['first_name'];
        }
        if(isset($request['message']['from']['last_name'])){
            $last_name = $request['message']['from']['last_name'];
        }
        if(isset($request['message']['from']['username'])){
            $username = $request['message']['from']['username'];
        }
        if(isset($request['message']['reply_to_message']['message_id'])){
            $replymessage = $request['message']['reply_to_message']['message_id'];
        }
        if($contact){
            $user = $this->saveContact($contact, $token);
            if($user){
                return $this->menu1($user->telegram_id, $telegram, $token);
            }
        }
        if(!$contact){
            if($text == '/start'){
                return $this->sendButtonsForContact($chat_id, $telegram, $replymessage = 1, $text = 1, $token);
            }
            if($text == $this->button3 || $text == $this->button4){
                return $this->sendButtonsForContact($chat_id, $telegram, $replymessage, $text, $token);
            }
            if($text == $this->button2){
                return $this->menu2($chat_id, $telegram, $token);
            }
            if($text == $this->menubutton1){
                return $this->sendmenubutton1($chat_id, $telegram, $token);
            }
            if($text == $this->menubutton5){
                return $telegram->sendMessage($chat_id, $this->menubutton55, $token);
            }
            if($text == $this->menubutton6){
                return $telegram->sendMessage($chat_id, $this->menubutton66, $token);
            }
            if ($text == $this->menubuttonreg) {
                $user = TelegramUser::where('telegram_id', $chat_id)->first();
                if ($user->active == 0) {
                    $question = CallBackQuestion::firstOrCreate(['telegram_user_id' => $chat_id], ['question_id' => 1]);
                    $question->question_id = 1;
                    $question->save();
                    $message = Question::find(1)->question;
                    return $telegram->sendMessageHtml($chat_id, $message, $token);
                }
                if ($user->active == 1) {
                    $mess = CallBackQuestion::where('telegram_user_id', $chat_id)->first();
                    $mess->question_id = 1;
                    $mess->save();
                    $user->active = 0;
                    $user->original_last_name = null;
                    $user->original_first_name = null;
                    $user->save();
                    $message = Question::find(1)->question;
                    return $telegram->sendMessageHtml($chat_id, $message, $token);
                }
            }
            $question_chat_id = CallBackQuestion::where('telegram_user_id', $chat_id)->first();
        
            if($question_chat_id && $question_chat_id->question_id < 4){
                $q = $question_chat_id->question_id;
                $user = TelegramUser::where('telegram_id', $chat_id)->first();
                if ($q == 1) {
                    $user->original_first_name = $text;
                    $user->save();
                    $question_chat_id->question_id = 2;
                    $question_chat_id->save();
                    $message = Question::find($question_chat_id->question_id)->question;
                    return $telegram->sendMessageHtml($chat_id, $message, $token);
                }
                if($q == 2){
                    $user->original_last_name = $text;
                    $user->save();
                    $question_chat_id->question_id = 3;
                    $question_chat_id->save();
                    $message = Question::find($question_chat_id->question_id)->question;
                    return $telegram->sendMessageHtml($chat_id, $message, $token);
                }
                if($q == 3){
                    $user->number2 = $text;
                    $user->active = 1;
                    $user->save();
                    $question_chat_id->question_id = 4;
                    $question_chat_id->save();
                    $message = Question::find($question_chat_id->question_id)->question;
                    $telegram->sendMessageHtml($chat_id, $message, $token);
                    return $this->menu1($chat_id, $telegram, $token);
                }
            }
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
        //Log::debug($request['message']['text']);
    }
    public function sendmessage(Telegram $telegram)
        {
            $chat_id = 34764210;
            $text = "\u{1F92D}Ошна ишладими?";
            $button = [
                    'keyboard' =>
                    [
                        [
                            [
                                'text' => "\u{2705}Манзил",
                            ],
                            [
                                'text' => "\u{2705}Адрес",
                            ],
                            [
                                'text' => "\u{2705}Адрес",
                            ],
                        ],
                    ],
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                ];
            $messag = $telegram->sendMessageHtml($chat_id, $text, 3);
            $sss = json_decode($messag, JSON_PRETTY_PRINT);
            $telegram->sendMessageHtml($chat_id, $sss, 3);
            dd($sss);
            
    }
    public function getmessage2(Request $request, Telegram $telegram, $token = 2){
        return $this->getmessage($request, $telegram, $token);
    }
    public function gettestmessage3(Request $request, Telegram $telegram, $token = 3){
        Log::debug($request);
        $chat_id = 34764210;
        $messag = $telegram->sendMessageHtml($chat_id, $request->all(), 3);
        $sss = json_decode($messag, JSON_PRETTY_PRINT);
        return $telegram->sendMessageHtml($chat_id, $sss, 3);


    }

    
}
