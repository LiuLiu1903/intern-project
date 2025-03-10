<?php

use App\Http\Controllers\Backend\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [AuthController::class, 'login'])-> name('auth.login');