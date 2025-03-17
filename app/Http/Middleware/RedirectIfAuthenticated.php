<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard()->check()) {
            return redirect('/home'); // Chuyển hướng đến trang bạn muốn
        }

        return $next($request);
    }
}
