<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckUserStatus;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Route mặc định
Route::get('/', function () {
    return view('welcome');
});

// Gửi email test
Route::get('/send-mail', function () {
    Mail::to('test@example.com')->send(new TestMail());
    return 'Mail đã được gửi thành công!';
});

// Đăng ký
Route::get('/register', [RegisterController::class, 'create'])->name('register'); // Form đăng ký
Route::post('/register', [RegisterController::class, 'store']);                   // Xử lý đăng ký

// ✅ Thêm route xác nhận email
Route::get('/verify-email/{token}', [RegisterController::class, 'verifyEmail'])->name('verify.email');

// Đăng nhập/Đăng xuất
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Quên mật khẩu
Route::middleware('guest')->group(function () {
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('/forgot-password', 'showLinkRequestForm')->name('password.request');
        Route::post('/forgot-password', 'sendResetLinkEmail')->name('password.email');
        Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
        Route::post('/reset-password', 'reset')->name('password.update');
    });
});

Route::middleware(['auth', CheckUserStatus::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Quản lý bài viết

    Route::middleware(['auth'])->group(function () {
        Route::resource('posts', PostController::class);
    });

    // Cập nhật hồ sơ có sử dụng binding models
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth');
});
