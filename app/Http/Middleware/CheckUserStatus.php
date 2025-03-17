<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->status === 0) {
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đang chờ phê duyệt.');
            }
            if (Auth::user()->status === 2) {
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị từ chối.');
            }
            if (Auth::user()->status === 3) {
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị khóa.');
            }
        }

        return $next($request);
    }
}
