<?php

use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\DiskonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthPenjualController;
use App\Http\Controllers\AuthPelangganController;
use App\Http\Middleware\AuthPenjual;
use App\Http\Middleware\AuthPelanggan;


Route::get('/', function () {
    return view('home');
});

Route::get('login-penjual', function () {
    return view('login-penjual');
});

Route::get('dashboard-penjual', function () {
    return view('dashboard-penjual');
})->middleware(AuthPenjual::class);

Route::get('dashboard-pelanggan', function () {
    return view('dashboard-pelanggan');
})->middleware(AuthPelanggan::class);

Route::resource('diskons', DiskonController::class);
Route::resource('kategori_produks', KategoriProdukController::class);

Route::get('register-penjual', [AuthPenjualController::class, 'register_penjual'])->name('register-penjual');
Route::post('register-penjual', [AuthPenjualController::class, 'post_register_penjual'])->name('post-register-penjual');

Route::get('login-penjual', [AuthPenjualController::class, 'login_penjual'])->name('login-penjual');
Route::post('login-penjual', [AuthPenjualController::class, 'post_login_penjual'])->name('post-login-penjual');

Route::post('logout-penjual', [AuthPenjualController::class, 'logout_penjual'])->name('logout-penjual');

Route::get('register-pelanggan', [AuthPelangganController::class, 'register_pelanggan'])->name('register-pelanggan');
Route::post('register-pelanggan', [AuthPelangganController::class, 'post_register_pelanggan'])->name('post-register-pelanggan');

Route::get('login-pelanggan', [AuthPelangganController::class, 'login_pelanggan'])->name('login-pelanggan');
Route::post('login-pelanggan', [AuthPelangganController::class, 'post_login_pelanggan'])->name('post-login-pelanggan');

Route::post('logout-pelanggan', [AuthPelangganController::class, 'logout_pelanggan'])->name('logout-pelanggan');


