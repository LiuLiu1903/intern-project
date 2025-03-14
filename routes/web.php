<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('home', [AuthController::class, 'home'])->name('auth.login');

Route::get('home', function () {
    return view('admin.index');
});

use App\Mail\TestMail;  
use Illuminate\Support\Facades\Mail;  

Route::get('/send-mail', function () {  
    Mail::to('test@example.com')->send(new TestMail());  
    return 'Mail đã được gửi thành công!';  
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
});  
