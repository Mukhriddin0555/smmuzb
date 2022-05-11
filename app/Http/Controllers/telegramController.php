<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\CallBackQuestion;
use App\Models\Question;
use App\Models\TelegramUser;
use App\Models\Veryfication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class telegramController extends Controller
{
    protected $textagree = 'Хурматли мижоз сизни уз мижозларимиз сафига кушилишингизни илтимос киламиз, бунинг учун сизга уз контактингизни юборишингиз кифоя, бу билансиз Бизнинг дуконимизда болайотган скидкалар хакида хабарлар олиб туришингиз мумки ва кушимча скидкаларга эга болишнгиз мумкин. Асосийси хар ой утказиладиган ютукли ойинларда катнашиш имкониятига эга боласиз.';
    protected $button1 = 'Юбориш';
    protected $button2 = 'Рози эмасман';
    protected $button3 = 'Ха албатта';
    protected $button4 = 'Йук бошка';
    protected $textveryficated = 'Хурматли мижоз сизга хизмат курсатишдан мамнунмиз!';
    protected $textveryfication = 'Хурматли мижоз хуш келибсиз, 
            телефон ракамингизни тасдиклашингизни илтимос киламиз. 
            Ушбу ракам сизга тегишлими?';
    protected $menubuttonreg = 'Чегирма олиш учун Руйхатдан утиш';
    protected $menubutton1 = 'Чегирма учун берилган ракам';
    protected $menubutton2 = 'Янги скидкалар хакида';
    protected $menubutton3 = 'Статус';
    protected $menubutton4 = 'Харидларим';
    protected $menubutton5 = 'Биз билан богланиш';
    protected $menubutton6 = 'Бизнинг Манзил';
    protected $menu2button1 = 'Контакт юбориш';
    protected $menu2button2 = 'Манзилимиз';
    protected $menu2button3 = 'Янгиликлар';
    protected $menubutton66 = 'Бизнинг Манзил: Андижон ш. Бобуршох кучаси 1-уй';
    protected $menubutton55 = 'Биз билан богланиш: @smmuzb3737, +998938033737';

    public function saveContact($contact, $replymessage){
        $number = $contact['phone_number'];
        $first_name = $contact['first_name'];
        $last_name = $contact['last_name'];
        $user_id = $contact['user_id'];
        $user = TelegramUser::where('number', strval($number))->first();
        $count = TelegramUser::where('number', strval($number))->count();
        if( $count < 1){
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
            return $user;
        }else{
            return $user;
        }
        

    }
    public function menu1($telegram_id, $telegram){
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
                ]
        ];
        $telegram->sendButtons($telegram_id, $this->textveryficated, $menu1);
    }
    public function menu2($telegram_id, $telegram){
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
                            'text' => $this->menu2button5
                        ]
                    ],
                    [
                        [
                            'text' => $this->menu2button5
                        ]
                    ],
                ]
        ];
        $telegram->sendButtons($telegram_id, $this->textagree, $menu2);
    }
    public function sendContactVerify($chat_id, $telegram){
            $text = $this->textveryfication;
            $button = [
                    'keyboard' =>
                    [
                        [
                            [
                                'text' => $this->button3,
                            ],
                        ],
                        [
                            [
                                'text' => $this->button4,
                            ]
                        ],
                    ],
                    'one_time_keyboard' => true,
                ];
            $message = $telegram->sendButtons($chat_id, $text, $button);
            $message = json_decode($message);
            $verify = new Veryfication();
            $verify->message_id = $message->result->message_id;
            $verify->chat_id = $chat_id;
            $verify->save();
            //Log::debug($message);

    }


    public function sendButtonsForContact($chat_id, $telegram, $replymessage = 1, $text = 1){
        $identfiedclient = TelegramUser::where('telegram_id', $chat_id)->first();

        if($identfiedclient && $replymessage == 1 && $text == 1){
            return $this->sendContactVerify($chat_id, $telegram);
        }
        if($identfiedclient && $replymessage != 1 && $text != 1){
            return $this->editContactVerify($chat_id, $telegram, $replymessage, $text);
        }
        if(!$identfiedclient){
            return $this->sendRequestContact($chat_id, $telegram);
        }

    }
    public function editContactVerify($chat_id, $telegram, $replymessage, $text){
        $yes = 'Ха албатта';
        $no = 'Йук бошка';
        $identfiedclient = TelegramUser::where('telegram_id', $chat_id)->first();
        $reply_message = Veryfication::where('message_id', $replymessage)->first();

        if($text == $yes){
            return $this->menu1($chat_id, $telegram);
            
        }
        if($text == $no){
            $identfiedclient->delete();
            return $this->sendRequestContact($chat_id, $telegram);
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
                    ],
                ],
                [
                    [
                        'text' => $this->button2,
                        'request_contact' => false,
                    ]
                ]
            ],
            'one_time_keyboard' => true,
        ];
            $message = $telegram->sendButtons($chat_id, $this->textagree, $button);
            $message = json_decode($message);
            $verify = new Veryfication();
            $verify->message_id = $message->result->message_id;
            $verify->chat_id = $chat_id;
            $verify->save();
        
    }

    public function sendmenubutton1($chat_id, $telegram){
        $user = TelegramUser::where('telegram_id', $chat_id)->first();
        if($user->original_last_name == null){
            $telegram->sendmessage($chat_id, 'Чегирма учун ракамни колга киритиш учун руйхатдан утишингиз керак болади');
            //$telegram->sendmessage($chat_id, 'Чегирма учун ракамни колга киритиш учун ушбу хаволага утиб исм шарифингизни бизга юборинг:<br>https://smmuzb.uz/contact/updated/'. random_int(100, 999) . $user->id . random_int(100, 999));
        }
        if($user->original_last_name != null){
            return $telegram->sendmessage($chat_id, 'Сизга берилган чегирма раками:'. $user->discount_number);
        }
    }

    public function getmessage(Request $request, Telegram $telegram)
    {
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
            $user = $this->saveContact($contact, $replymessage);
            if($user){
                $this->menu1($user->telegram_id, $telegram);
            }
        }
        if(!$contact){
            if($text == '/start'){
                return $this->sendButtonsForContact($chat_id, $telegram);
            }
            if($text == $this->button3 || $text == $this->button4){
                return $this->sendButtonsForContact($chat_id, $telegram, $replymessage, $text);
            }
            if($text == $this->button2){
                return $this->sendButtonsForContact($chat_id, $telegram, $replymessage, $text);
            }
            if($text == $this->menubutton1){
                if(TelegramUser::where('telegram_id', $chat_id)->count())
                return $this->sendmenubutton1($chat_id, $telegram, $text);
            }
            if($text == $this->menubutton5){
                $telegram->sendMessage($chat_id, $this->menubutton55);
            }
            if($text == $this->menubutton6){
                $telegram->sendMessage($chat_id, $this->menubutton66);
            }

            
        }
        
        if($text == $this->menubuttonreg){
            $user = TelegramUser::where('telegram_id', $chat_id)->first();
            if (isset($user->active)) {
                if ($user->active == 0) {
                    $question = new CallBackQuestion();
                    $question->telegram_user_id = $chat_id;
                    $question->question_id = 1;
                    $question->save();
                    $message = Question::find(1)->question;
                    $telegram->sendMessageHtml($chat_id, $message);
                }
            }
            if($user->active == 1){
                CallBackQuestion::where('telegram_user_id', $chat_id)->delete();
                $user->active = 0;
                $user->original_last_name = null;
                $user->original_last_name == null;
                $user->save();
                $message = Question::find(1)->question;
                $telegram->sendMessageHtml($chat_id, $message);

            }
        $question_chat_id = CallBackQuestion::where('telegram_user_id', $chat_id)->count() + 1;
        
        }
        if($question_chat_id > 1 && $question_chat_id < 5){
            $user = TelegramUser::where('telegram_id', $chat_id)->first();
            if($question_chat_id == 2){
                if($user->original_first_name == null){
                    $user->original_first_name = $text;
                    $user->save();
                    $message = Question::find($question_chat_id)->question;
                    $telegram->sendMessageHtml($chat_id, $message);
                }
            }
            
            if($question_chat_id == 3){
                if($user->original_last_name == null){
                    $user->original_last_name = $text;
                    $user->save();
                    $message = Question::find($question_chat_id)->question;
                    $telegram->sendMessageHtml($chat_id, $message);
                }
            }
            if($question_chat_id == 4){
                    $user->number2 = $text;
                    $user->active = 1;
                    $user->save();
                    $message = Question::find($question_chat_id)->question;
                    $telegram->sendMessageHtml($chat_id, $message);
                
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
