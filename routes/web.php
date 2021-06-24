<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\OrderController;

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

Route::get('/', function () {
    return redirect('login');
});


Route::resource('/login', LoginController::class);
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::resource('/register', RegisterController::class);

Route::middleware(['auth'])->group(function(){
    Route::get('/member-area',[UserController::class,'index']);
    Route::post('/member-area',[UserController::class,'store']);
    Route::get('/member-area/success',[OrderController::class,'success']);
    Route::resource('/member-area/product',ProductController::class);
    Route::resource('/member-area/prepaid-balance',TopUpController::class);
    Route::get('/member-area/payment/{id}',[OrderController::class,'payment'])->name('member.payment');
    Route::resource('/member-area/order',OrderController::class);
});