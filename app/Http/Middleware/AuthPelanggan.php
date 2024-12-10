<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthPelanggan
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('pelanggan')->check()) {
            return redirect('/login-pelanggan')->withErrors('Silakan login sebagai pelanggan.');
        }
        return $next($request);
    }
}

