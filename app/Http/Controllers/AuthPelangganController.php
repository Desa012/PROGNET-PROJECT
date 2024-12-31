<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Facade;

class AuthPelangganController extends Controller
{
    public function register_pelanggan(Request $request)
    {
        return view('register-pelanggan');
    }

    public function post_register_pelanggan(Request $request)
    {
        \Log::info('Data yang diterima: ', $request->all());

        $validated = $request->validate([
            'nama'  => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:8|confirmed',
        ]);

        \Log::info('Validasi berhasil: ', $validated);

        User::create([
            'nama'  => $validated['nama'],
            'email'  => $validated['email'],
            'password'  => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function login_pelanggan(Request $request)
    {
        return view('login-pelanggan');
    }

    public function post_login_pelanggan(Request $request)
    {
        \Log::info('Data request login:', $request->all());

        $credential = $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        \Log::info('Credential setelah validasi:', $credential);

        $user = User::where('email', $credential['email'])->first();

        if ($user && Hash::check($credential['password'], $user->password)) {
            \Log::info('Password berhasil diverifikasi.');

            if ($user->role !== 'pelanggan') {
                return back()->withErrors(['email' => 'Akun ini bukan akun pelanggan.']);
            }

            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('dashboard-pelanggan')->with('success', 'Login berhasil!');
        }

        \Log::error('Login gagal: Email atau password salah');

        return back()->withErrors([
            'email'  => 'Email atau password salah.'
        ])->onlyInput('email');
    }

    public function logout_pelanggan(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-pelanggan');
    }
}
