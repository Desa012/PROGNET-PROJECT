<?php

use App\Http\Controllers\KontakController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::resource('kontaks', KontakController::class);

Route::get('about', function () {
    return view('about');
});

Route::get('register-penjual', [AuthController::class, 'register_penjual'])->name('register-penjual');
Route::post('register-penjual', [AuthController::class, 'post_register_penjual'])->name('post-register-penjual');

Route::get('login-penjual', [AuthController::class, 'login_penjual'])->name('login-penjual');
Route::post('login-penjual', [AuthController::class, 'post_login_penjual'])->name('post-login-penjual');

Route::post('logout-penjual', [AuthController::class, 'logout_penjual'])->name('logout-penjual');
