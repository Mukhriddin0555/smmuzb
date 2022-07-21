<?php

namespace App\Http\Controllers;

use App\Models\ForBot;
use App\Helpers\TgUser;
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
    protected $notactive = "Чегирма учун ракамни колга киритиш учун руйхатдан утишингиз керак болади";

    public function menu1($tguser, Telegram $telegram){
        $button = $tguser->userfirst->active ? $this->menubuttonreg : $this->menubutton1;
        $menu1 = [
            'keyboard' =>
                [
                    [
                        
                        ['text' => $button]
                        
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
        return $telegram->sendButtons($tguser->userfirst->chat_id, $this->textveryficated, $menu1);
    }
    public function menu2($tguser, Telegram $telegram){
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
        return $telegram->sendButtons($tguser->userfirst->chat_id, $this->textagree, $menu2);
    }
    public function sendContactVerify($tguser, Telegram $telegram){
            $text = $tguser->userfirst->original_last_name . "\n". 
                    $tguser->userfirst->original_first_name . "\n".
                    $tguser->userfirst->number2 . "\n".
                    BotToken::find(1)->bot_name . $this->vt2;
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
            return $telegram->sendButtons($tguser->userfist->chat_id, $text, $button);
            //Log::debug($message);

    }


    public function sendButtonsForContact($tguser, $telegram){
        return $tguser->userfist->active ? $this->sendContactVerify($tguser, $telegram) : $this->sendRequestContact($tguser, $telegram);
    }
    public function editContactVerify($tguser, Telegram $telegram){
        if($tguser->text == $this->button3){
            return $this->menu1($tguser->chat_id, $telegram);
        }else{
            $user = TelegramUser::find($tguser->userfirst->id);
            $user->active = 0;
            $user->save();
            return $this->sendRequestContact($tguser, $telegram);
        }
    }
    public function sendRequestContact($tguser, Telegram $telegram){
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
        return $telegram->sendButtons($tguser->userfirst->chat_id, $this->textagree, $button);
    }

    public function sendmenubutton1($tguser, Telegram $telegram){
        $a = $tguser->userfirst->chat_id;
        $b = "Сизга берилган чегирма раками:\n     " . $tguser->userfirst->discount_number;
        return $tguser->userfirst->active ? $telegram->sendmessage($a, $b) : $telegram->sendmessage($a, $this->notactive);
    }

    public function getmessage(Request $request, Telegram $telegram)
    {
        //Log::debug($request);
        $tguser = new TgUser($request);
        if($tguser->contact){
            return $this->menu1($tguser, $telegram);
        }
        if(!$tguser->contact){
            if($tguser->text == '/start'){
                return $this->sendButtonsForContact($tguser, $telegram);
            }
            if($tguser->text == $this->button3 || $tguser->text == $this->button4){
                return $this->editContactVerify($tguser, $telegram);
            }
            if($tguser->text == $this->button2){
                return $this->menu2($tguser, $telegram);
            }
            if($tguser->text == $this->menubutton1){
                return $this->sendmenubutton1($tguser, $telegram);
            }
            if($tguser->text == $this->menubutton5){
                return $telegram->sendMessage($tguser->chat_id, $this->menubutton55);
            }
            if($tguser->text == $this->menubutton6){
                return $telegram->sendMessage($tguser->chat_id, $this->menubutton66);
            }
            if ($tguser->text == $this->menubuttonreg) {
                if ($tguser->userfirst->active == 0) {
                    $question = CallBackQuestion::firstOrCreate(['telegram_user_id' => $tguser->chat_id], ['question_id' => 1]);
                    $question->question_id = 1;
                    $question->save();
                    $message = Question::find(1)->question;
                    return $telegram->sendMessageHtml($tguser->chat_id, $message);
                }
                if ($tguser->userfirst->active == 1) {
                    $mess = CallBackQuestion::where('telegram_user_id', $tguser->chat_id)->first();
                    $mess->question_id = 1;
                    $mess->save();
                    $user = TelegramUser::find($tguser->userfirst->id);
                    $user->active = 0;
                    $user->original_last_name = null;
                    $user->original_first_name = null;
                    $user->save();
                    $message = Question::find(1)->question;
                    return $telegram->sendMessageHtml($tguser->chat_id, $message);
                }
            }
            $question_chat_id = CallBackQuestion::where('telegram_user_id', $tguser->chat_id)->first();
        
            if($question_chat_id && $question_chat_id->question_id < 4){
                $q = $question_chat_id->question_id;
                $user = TelegramUser::where('telegram_id', $tguser->chat_id)->first();
                if ($q == 1) {
                    $user->original_first_name = $tguser->text;
                    $user->save();
                    $question_chat_id->question_id = 2;
                    $question_chat_id->save();
                    $message = Question::find(2)->question;
                    return $telegram->sendMessageHtml($tguser->chat_id, $message);
                }
                if($q == 2){
                    $user->original_last_name = $tguser->text;
                    $user->save();
                    $question_chat_id->question_id = 3;
                    $question_chat_id->save();
                    $message = Question::find(3)->question;
                    return $telegram->sendMessageHtml($tguser->chat_id, $message);
                }
                if($q == 3){
                    $user->number2 = $tguser->text;
                    $user->active = 1;
                    $user->save();
                    $question_chat_id->question_id = 4;
                    $question_chat_id->save();
                    $message = Question::find($question_chat_id->question_id)->question;
                    $telegram->sendMessageHtml($tguser->chat_id, $message);
                    return $this->menu1($tguser, $telegram);
                }
            }
        }
        //Log::debug($request['message']['text']);
    }
    public function sendmessage(Telegram $telegram)
        {
            $chat_id = 34764210;
            $text = "\u{1F92D}қўшна ишладими?";
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
            dd($sss);
            
    }
    /*public function getmessage2(Request $request, Telegram $telegram){
        return $this->getmessage($request, $telegram);
    }
    public function gettestmessage3(Request $request, Telegram $telegram){
        Log::debug($request);
        $chat_id = 34764210;
        $messag = $telegram->sendMessageHtml($chat_id, $request->all());
        $sss = json_decode($messag, JSON_PRETTY_PRINT);
        return $telegram->sendMessageHtml($chat_id, $sss);


    }*/
    public function usersendcontact(Request $req, Telegram $telegram){
        $chat_id = 5384353797;
        $text = "SMMUZB.UZ Сайтидан навбатдаги мурожаат:
        Мурожаатчи: $req->name
        Тел. раками: $req->number
        Email: $req->email
        Matn: $req->message";

        $telegram->sendMessage($chat_id, $text, 3);
        return back();
    }

    
}
