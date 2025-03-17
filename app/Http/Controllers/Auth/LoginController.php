<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
        }

        // Kiểm tra trạng thái tài khoản
        if ($user->status === 0) {
            return back()->withErrors(['status' => 'Tài khoản đang chờ phê duyệt']);
        }

        if ($user->status === 2) {
            return back()->withErrors(['status' => 'Tài khoản đã bị từ chối']);
        }

        if ($user->status === 3) {
            return back()->withErrors(['status' => 'Tài khoản đã bị khóa']);
        }

        // Đăng nhập thành công
        Auth::login($user);

        return redirect()->route('posts.index')->with('success', 'Đăng nhập thành công');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
