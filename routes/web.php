<?php

use Spatie\Emoji\Emoji;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\telegramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищенный";
});
Route::get('emoji', function(){
    return dd(Emoji::all()); 
});
Route::get('/contact/updated/{id}', [Controller::class, 'register'])
                ->name('register');
Route::get('/contact/sucsess', [Controller::class, 'sucsess'])
                ->name('sucsess');
Route::post('/contact/update/{id}', [Controller::class, 'registered'])
                ->name('registered');
Route::get('/sendmessage', [telegramController::class, 'sendmessage'])
                ->name('sendmessage');
Route::post('/ssmmalumot', [telegramController::class, 'getmessage'])
                ->name('getmessage');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
