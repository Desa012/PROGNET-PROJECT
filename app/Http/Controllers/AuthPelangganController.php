<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
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
            'nama_pelanggan'  => 'required',
            'email'     => 'required|email|unique:pelanggans,email',
            'password_pelanggan'  => 'required|string|min:8|confirmed',
            'alamat' => 'required',
        ]);

        \Log::info('Validasi berhasil: ', $validated);

        Pelanggan::create([
            'nama_pelanggan'  => $validated['nama_pelanggan'],
            'email'  => $validated['email'],
            'password_pelanggan'  => Hash::make($validated['password_pelanggan']),
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('login-pelanggan')->with('success', 'Registrasi berhasil!');
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
            'password_pelanggan'  => 'required',
        ]);

        \Log::info('Credential setelah validasi:', $credential);

        $pelanggan = Pelanggan::where('email', $credential['email'])->first();

        if ($pelanggan && Hash::check($credential['password_pelanggan'], $pelanggan->password_pelanggan)) {
            \Log::info('Password berhasil diverifikasi.');

            Auth::guard('pelanggan')->login($pelanggan);

            $request->session()->regenerate();

            return redirect()->intended('dashboard-pelanggan')->with('success', 'Login berhasil!');
        }

        \Log::error('Login gagal: Email atau password salah');

        return back()->withErrors([
            'email'  => 'Email atau password salah.'
        ])->onlyInput('email');
    }

    public function logout_pelanggan(Request $request)
    {
        Auth::guard('pelanggan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-pelanggan');
    }
}
