<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthPelanggan
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->withErrors('Silakan login sebagai pelanggan.');
        }

        if (Auth::user()->role !== 'pelanggan' && Auth::user()->role !== 'penjual') {
            return redirect('/login')->withErrors('Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}

