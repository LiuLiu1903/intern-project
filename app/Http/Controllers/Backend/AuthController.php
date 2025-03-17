<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function __construct(){

    
    }
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kiểm tra trạng thái tài khoản
            if ($user->status === 0) {
                Auth::logout();
                return back()->with('error', 'Tài khoản đang chờ phê duyệt.');
            }

            if ($user->status === 2) {
                Auth::logout();
                return back()->with('error', 'Tài khoản bị từ chối.');
            }

            if ($user->status === 3) {
                Auth::logout();
                return back()->with('error', 'Tài khoản đã bị khóa.');
            }

            return redirect()->route('posts.index')->with('success', 'Đăng nhập thành công');
        }

        return back()->with('error', 'Thông tin đăng nhập không chính xác.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
