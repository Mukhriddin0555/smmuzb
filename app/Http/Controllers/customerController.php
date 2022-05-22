<?php

namespace App\Http\Controllers;

use App\Models\BotToken;
use App\Models\SaleProduct;
use App\Models\TelegramUser;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class customerController extends Controller
{
    public function customer(){
        return view('customer');
    }
    public function userfind(Request $request){
        $tguser = TelegramUser::where('discount_number', $request->discount)
        ->with('saleproducts')
        ->first();
        
        if($tguser != null){
            $tgsum = SaleProduct::where('telegram_user_id', $tguser->id)->sum('price_amount');
            return view('customer', ['user' => $tguser, 'sum' => $tgsum]);
            //dd(is_bool($tguser->saleproducts));
        }
        //dd($tguser);
        return redirect()->route('customer')->with('danger', 'Харидор топилмади');
    }
    public function addsales($id, Request $request){
        $sale = new SaleProduct();
        $sale->telegram_user_id = $id;
        $sale->price_amount = $request->amount;
        $sale->discount = 2;
        $sale->user_id = Auth::user()->id;
        $sale->save();
        $tguser = TelegramUser::where('id', $id)
        ->with('saleproducts')
        ->first();
        return back();
    }
    public function salessucsess(){
        
    }
    public function salesdelete(){
        
    }
    public function eloquent(){
        $bot = TelegramUser::addSelect(['bot' => BotToken::select('token')->whereColumn('id', 'telegram_users.bot_token_id')])->get();
        
        dd(BotToken::all()[0]->token);
    }
}
