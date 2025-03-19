<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterRequest;
use App\Mail\WelcomeMail;
use Illuminate\Support\Str; // ✅ Import đúng namespace cho Str

class RegisterController extends Controller
{
    // Hiển thị form đăng ký
    public function create()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký tài khoản
    public function store(RegisterRequest $request)
    {
        try {
            // ✅ Lấy dữ liệu trực tiếp từ request (không cần dùng only())
            $user = User::create([
                'first_name' => $request->validated('first_name'),
                'last_name' => $request->validated('last_name'),
                'email' => $request->validated('email'),
                'password' => Hash::make($request->validated('password')),
                'status' => 0,
                'verification_token' => Str::random(60),
            ]);
            

            // ✅ Gửi email xác nhận
            Mail::to($user->email)->send(new WelcomeMail($user));

            // ✅ Gửi sự kiện kích hoạt email nếu dùng Laravel Event
            event(new Registered($user));

            // ✅ Chuyển hướng về trang đăng nhập với thông báo thành công
            return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công! Vui lòng kiểm tra email để xác nhận tài khoản.');
        } catch (\Exception $e) {
            // ✅ Xử lý lỗi trong quá trình đăng ký
            return redirect()->route('register')->with('error', 'Có lỗi xảy ra trong quá trình đăng ký: ' . $e->getMessage());
        }
    }

    // Xử lý xác nhận email
    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Token xác minh không hợp lệ.');
        }

        $user->update([
            'status' => 1, // Kích hoạt tài khoản
            'verification_token' => null,
            'email_verified_at' => now(),
        ]);

        // ✅ Đăng nhập sau khi xác nhận thành công (nếu muốn)
        Auth::login($user);

        // ✅ Chuyển hướng về dashboard với thông báo thành công
        return redirect()->route('dashboard')->with('success', 'Tài khoản đã được kích hoạt thành công!');
    }
}
