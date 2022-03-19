<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
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
Route::group(['middleware'=>'guest'],function(){
    Route::get('/login',[AuthController::class,'loginShow'])->name('login');
    Route::get('/register',[AuthController::class,'regShow'])->name('register');
    Route::post('/login',[AuthController::class,'login'])->name('login');
    Route::post('/register',[AuthController::class,'register'])->name('register');
});

Route::group(['middleware'=>'auth','namespace'=>'App\Http\Controllers'],function(){
    Route::get('/', [AppointmentController::class,'index'])->name('/');
    Route::post('/filter', [AppointmentController::class,'filter'])->name('appointments.filter');
    Route::resource('appointments','AppointmentController');
    Route::resource('therapyRooms','TherapyRoomController');
    Route::resource('users','userController');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');

    /*Route::resource([
        'appointments'=>'AppointmentController',
        'therapyRoom'=>'TherapyRoomController',
        'user'=>'userController'
    ]);*/
});

