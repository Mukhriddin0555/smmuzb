<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\customerController;
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
Route::get('/contact/updated/{id}', [Controller::class, 'register'])
                ->name('register');
Route::get('/contact/sucsess', [Controller::class, 'sucsess'])
                ->name('sucsess');
Route::post('/contact/update/{id}', [Controller::class, 'registered'])
                ->name('registered');
Route::get('/sendmessage', [telegramController::class, 'sendmessage'])
                ->name('sendmessage');
Route::post('/smmmalumot', [telegramController::class, 'getmessage'])
                ->name('getmessage');//webhook
/*Route::post('/gettestmessage3', [telegramController::class, 'gettestmessage3'])
                ->name('gettestmessage3');//webhook
Route::post('/billionaire', [telegramController::class, 'getmessage2'])
                ->name('getmessage2');//webhook billionaire*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/eloquent', [customerController::class, 'eloquent'])
                ->name('eloquent'); //тест
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::post('/usersendcontact', [telegramController::class, 'usersendcontact'])
                ->name('usersendcontact');

Route::middleware(['admin','auth'])->group(function(){
    Route::get('/admin', [adminController::class, 'admin'])->name('admin');
    //фойдаланувчиларни кушиш, куриш, узгартириш ва учириш учун
    Route::get('/users/{column?}/{sort?}',[adminController::class, 'allUsers'])->name('allUsers');
    Route::get('/user/{id}/get',[adminController::class, 'oneUser'])->name('oneUser');    
    Route::get('/user/{id}/delete',[adminController::class, 'deleteOneUser'])->name('deleteOneUser');

    Route::get('/usersadd/new',[adminController::class, 'newUser'])->name('newUser');
    Route::post('/usersadd/new',[adminController::class, 'addNewUser'])->name('addNewUser');

    Route::get('/user/{id}/edit',[adminController::class, 'editOneUser'])->name('editOneUser');
    Route::post('/user/{id}/edit',[adminController::class, 'updateOneUser'])->name('updateOneUser');
});

Route::middleware(['cust','auth'])->group(function(){
    Route::get('/customer', [customerController::class, 'customer'])->name('customer');
    Route::get('/userfind', [customerController::class, 'userfind'])->name('userfind');
    Route::get('/usersall', [customerController::class, 'usersall'])->name('usersall');
    Route::get('/sailtoday', [customerController::class, 'sailtoday'])->name('sailtoday');
    Route::get('/work', [customerController::class, 'salesman'])->name('salesman');
    Route::get('/verifycation/{id}', [customerController::class, 'pass'])->name('pass');
    Route::post('/verifycation', [customerController::class, 'passpost'])->name('passpost');
    Route::post('/usersfind/addsales/{id}',[customerController::class, 'addsales'])->name('addsales');    
    Route::get('/salessucsess/{id}',[customerController::class, 'salessucsess'])->name('salessucsess');
    Route::get('/salesdelete/{id}',[customerController::class, 'salesdelete'])->name('salesdelete');
});
require __DIR__.'/auth.php';
