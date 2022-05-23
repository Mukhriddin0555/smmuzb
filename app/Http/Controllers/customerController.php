<?php

namespace App\Http\Controllers;

use App\Models\BotToken;
use App\Models\ForBot;
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
            $tgsum = SaleProduct::where('telegram_user_id', $tguser->id)
            ->where('customer_id', Auth::user()->customer_id )
            ->sum('price_amount');
            return view('customer', ['user' => $tguser, 'sum' => $tgsum, 'customer' => Auth::user()->customer_id]);
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
        $sale->customer_id = Auth::user()->customer_id;
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
        $str = "\\xF0\\x9F\\x90\\xBC\\xF0\\x9Fs";
        $strpreg = preg_match("/\/", $str);
        dd($strpreg);
    }
}
