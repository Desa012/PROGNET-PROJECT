<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Facade;

class AuthController extends Controller
{
    public function register_penjual(Request $request)
    {
        return view('register-penjual');
    }

    public function post_register_penjual(Request $request)
    {
        \Log::info('Data yang diterima: ', $request->all());

        $validated = $request->validate([
            'nama_penjual'  => 'required',
            'deskripsi_toko'    => 'nullable',
            'email'     => 'required|email|unique:penjuals,email',
            'password_toko'  => 'required|string|min:8|confirmed',
        ]);

        \Log::info('Validasi berhasil: ', $validated);

        Penjual::create([
            'nama_penjual'  => $validated['nama_penjual'],
            'deskripsi_toko'  => $validated['deskripsi_toko'],
            'email'  => $validated['email'],
            'password_toko'  => Hash::make($validated['password_toko']),
        ]);

        return redirect()->route('login-penjual')->with('success', 'Registrasi berhasil!');
    }

    public function login_penjual(Request $request)
    {
        return view('login-penjual');
    }

    public function post_login_penjual(Request $request)
    {
        \Log::info('Data request login:', $request->all());

        $credential = $request->validate([
            'email'     => 'required',
            'password_toko'  => 'required',
        ]);

        \Log::info('Credential setelah validasi:', $credential);

        $penjual = Penjual::where('email', $credential['email'])->first();

        if ($penjual && Hash::check($credential['password_toko'], $penjual->password_toko)) {
            \Log::info('Password berhasil diverifikasi.');

            Auth::guard('penjual')->login($penjual);

            $request->session()->regenerate();

            return redirect()->intended('home')->with('success', 'Login berhasil!');
        }

        \Log::error('Login gagal: Email atau password salah');

        return back()->withErrors([
            'email'  => 'Email atau password salah.'
        ])->onlyInput('email');
    }

    public function logout_penjual(Request $request)
    {
        Auth::guard('penjual')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-penjual');
    }
}
