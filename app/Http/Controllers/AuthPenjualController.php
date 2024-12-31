<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Facade;

class AuthPenjualController extends Controller
{
    public function register_penjual(Request $request)
    {
        return view('register-penjual');
    }

    public function post_register_penjual(Request $request)
    {
        \Log::info('Data yang diterima: ', $request->all());

        $user = Auth::user();

        $validated = $request->validate([
            'nama_toko' => 'required|string|max:255',
            'deskripsi_toko' => 'required|string|max:255',
        ]);

        \Log::info('Validasi berhasil: ', $validated);

        Penjual::create([
            'id_user'  => $user->id_user,
            'nama_toko' => $validated['nama_toko'],
            'deskripsi_toko' => $validated['deskripsi_toko'],
        ]);

        $user->update(['role' => 'penjual']);

        $request->session()->regenerate();

        return redirect()->route('dashboard-penjual')->with('success', 'Registrasi toko berhasil!');
    }

    public function login_penjual(Request $request)
    {
        return view('login-penjual');
    }

    public function post_login_penjual(Request $request)
    {
        \Log::info('Data request login:', $request->all());

        $credential = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        \Log::info('Credential setelah validasi:', $credential);

        $user = User::where('email', $credential['email'])->first();

        if ($user && Hash::check($credential['password'], $users->password)) {
            \Log::info('Password berhasil diverifikasi.');

            if ($user->role !== 'penjual') {
                return back()->withErrors(['email' => 'Akun ini bukan akun penjual.']);
            }

            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('dashboard-penjual')->with('success', 'Login berhasil!');
        }

        \Log::error('Login gagal: Email atau password salah');

        return back()->withErrors([
            'email'  => 'Email atau password salah.'
        ])->onlyInput('email');
    }

    public function logout_penjual(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-penjual');
    }
}
