<?php

namespace App\Http\Controllers;

use App\Models\SaleProduct;
use App\Models\TelegramUser;
use Illuminate\Http\Request;

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
            return view('customer', ['user' => $tguser]);
            //dd(is_bool($tguser->saleproducts));
        }
        
        return redirect()->route('customer')->with('danger', 'Харидор топилмади');
    }
    public function addsales($id, Request $request){
        $sale = new SaleProduct();
        $sale->telegram_user_id = $id;
        $sale->price_amount = $request->amount;
        $sale->discount = 2;
        $sale->save();
        $tguser = TelegramUser::where('id', $id)
        ->with('saleproducts')
        ->first();
        //dd($tguser);
        return back();//view('customer', ['user' => $tguser]);
    }
    public function salessucsess(){
        
    }
    public function salesdelete(){
        
    }
}
