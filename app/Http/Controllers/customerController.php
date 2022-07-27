<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\SaleProduct;
use App\Models\TelegramUser;
use Illuminate\Http\Request;
use App\Models\CustomerSalesman;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class customerController extends Controller
{
    protected $password = 'smmsaidbek';

    public function customer(){
        return view('customer');
    }
    public function userfind(Request $request){
        $tguser = TelegramUser::where('discount_number', $request->discount)
        ->first();
        
        if($tguser != null){
            $tgsum = SaleProduct::where('telegram_user_id', $tguser->id)
            ->where('customer_id', Auth::user()->customer_id )
            ->sum('price_amount');
            $salesman = CustomerSalesman::where('customer_id', Auth::user()->customer_id)->get();
            return view('customer', [
                'user' => $tguser, 
                'sum' => $tgsum, 
                'customer' => Auth::user()->customer_id, 
                'salesman' => $salesman]);
            //dd($tguser);
        }
        //dd($tguser);
        return redirect()->route('customer')->with('danger', 'Харидор топилмади');
    }
    public function addsales($id, Request $request){
        /*$request->validate([
            'amount' => ['required'],
            'discount' => ['required', 'max:2'],
            'salesman_id' => ['required'],]);*/
        $validator = Validator::make($request->amount, $request->discount, $request->discount, $messages = [
                'required' => 'The :attribute field is required.',
            ]);
        $sale = new SaleProduct();
        $sale->telegram_user_id = $id;
        $sale->price_amount = $request->amount;
        $sale->discount = $request->discount;
        $sale->customer_id = Auth::user()->customer_id;
        $sale->customer_salesman_id = $request->salesman_id;
        $sale->save();
        $salesman = CustomerSalesman::find($request->salesman_id);
        $salesman->sales = intval($this->saled($request));
        $salesman->save();
        return back();
    }
    public function usersall(){
        $users = TelegramUser::withSum(['saleproducts' => function (Builder $query) {
            $query->where('customer_id', '=', Auth::user()->customer_id);
        }], 'price_amount')->orderBy('saleproducts_sum_price_amount', 'desc')->get();
        return view('customer', ['allusers' => $users]);
    }
    public function saled($request){

        $price = $request->amount - (($request->amount / 100) * $request->discount);
        return $price / 100;
    }
    public function salesman(){
        $sales = CustomerSalesman::where('customer_id', Auth::user()->customer_id)->get();
        return view('customer', ['salesmans' => $sales]);
    }
    public function pass($id){
        return view('customer', ['verify' => CustomerSalesman::find($id)]);
    }
    public function passpost(Request $request){
        $sales = CustomerSalesman::find($request->sales_id);
        if($request->password == $this->password){
            $sales->sales = 0;
            $sales->save();
            return redirect()->route('salesman')->with('sucsessed', 'Муваффакиятли бажарилди');
        }
        return back()->with('badpassword', 'Махфий код нотогри киритилган');
    }
    public function eloquent(){
        /*$question_chat_id = CallBackQuestion::where('telegram_user_id', 1234)->first();
        if($question_chat_id){
            echo('true');
        }else{
            echo('false');
        }*/
        /*$users = TelegramUser::join('for_bots', 'telegram_users.id', '=', 'for_bots.telegram_user_id')
        ->join('bot_tokens', 'for_bots.bot_token_id', '=', 'bot_tokens.id')
        ->join('sale_products', 'telegram_users.id', '=', 'sale_products.telegram_user_id')
        ->where('bot_tokens.customer_id', Auth::user()->customer_id)
        ->where('sale_products.customer_id', Auth::user()->customer_id)
        ->select('telegram_users.id','telegram_users.original_last_name as last_name', 'telegram_users.original_first_name as first_name',
         'telegram_users.number2 as number', 'sale_products.price_amount as amount',)
        ->groupBy('id')
        ->get();*/
        //$users  = Products::create(['product_name' => '🐼', 'product_amount' => 1]);
        $users = TelegramUser::withSum(['saleproducts' => function (Builder $query) {
            $query->where('customer_id', '=', 1);
        }], 'price_amount')->orderBy('saleproducts_sum_price_amount', 'desc')->get();
        dd($users);

        
        //$str1 = strlen($str);
        //$str2 = gettype($str);
        //dd($str[0]);
    }
}
