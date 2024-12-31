<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthPenjual
{
    public function handle($request, Closure $next)
    {
        // Cek apakah pengguna login sebagai penjual
        if (!Auth::check() || Auth::user()->role !== 'penjual') {
            return redirect('/login')->withErrors('Anda harus login sebagai penjual untuk mengakses halaman ini.');
        }
        return $next($request);
    }
}

