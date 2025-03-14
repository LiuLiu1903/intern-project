<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;



class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 0, // Mặc định là "Chờ phê duyệt"
        ]);

        // Gửi email xác nhận
        Mail::to($user->email)->send(new \App\Mail\WelcomeMail($user));

        // Thông báo thành công
        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công');
    }
}
