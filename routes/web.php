<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\AuthPenjualController;
use App\Http\Controllers\AuthPelangganController;
use App\Http\Middleware\AuthPenjual;
use App\Http\Middleware\AuthPelanggan;
use App\Http\Middleware\CheckPenjual;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardPenjualController;
use App\Http\Controllers\DashboardPelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\ProdukDetailController;


// Route untuk halaman home
Route::get('/', function () {
    return view('login-pelanggan');
});

// Route untuk register penjual
Route::get('register-penjual', [AuthPenjualController::class, 'register_penjual'])->name('register-penjual');
Route::post('register-penjual', [AuthPenjualController::class, 'post_register_penjual'])->name('post-register-penjual');


// Route untuk register pelanggan
Route::get('register-pelanggan', [AuthPelangganController::class, 'register_pelanggan'])->name('register-pelanggan');
Route::post('register-pelanggan', [AuthPelangganController::class, 'post_register_pelanggan'])->name('post-register-pelanggan');


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'post_login'])->name('post-login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk login dan dashboard penjual
Route::middleware([AuthPenjual::class, CheckPenjual::class])->group(function () {
    Route::get('dashboard-penjual', [DashboardPenjualController::class, 'index'])->name('dashboard-penjual');
});

// Route untuk login dan dashboard pelanggan
Route::middleware([AuthPelanggan::class])->group(function () {
    Route::get('dashboard-pelanggan', [DashboardPelangganController::class, 'index'])->name('dashboard-pelanggan');
});


// Route untuk resource diskon
Route::resource('diskons', DiskonController::class)->middleware(AuthPenjual::class);

// Route untuk produk
Route::resource('produks', ProdukController::class)->middleware(AuthPenjual::class);
Route::middleware([AuthPelanggan::class])->group(function () {
    Route::get('produks/show/{id_produk}', [ProdukDetailController::class, 'produk_detail'])->name('produksdetail.show');
});

// Route untuk kelola pesanan
Route::get('kelola-pesanan', [PesananController::class, 'kelolaPesanan'])->name('pesanan.kelola');

// Route untuk riwayat pesanan
Route::get('riwayat-pesanan', [PesananController::class, 'riwayatPesanan'])->name('pesanan.riwayat');
Route::get('detail-riwayat/{id_pesanan}', [PesananController::class, 'detailRiwayat'])->name('detail.riwayat');

//Pengiriman
Route::patch('/pengiriman{id}', [PesananController::class, 'updatePengiriman'])->name('pengiriman.update');

// Route untuk keranjang
Route::resource('keranjangs', KeranjangController::class)->middleware(AuthPelanggan::class);
Route::put('/keranjang/{id}', [KeranjangController::class, 'update'])->middleware(AuthPelanggan::class)->name('keranjangs.update');

// Route untuk pemesanan
Route::middleware([AuthPelanggan::class])->group(function () {
    Route::get('pesanans/create', [PesananController::class, 'create'])->name('pesanan.create');
    Route::get('pesanans/index', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('pesanans/store', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanans/{id_pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::put('/pesanans/{id_pesanan}/selesaikan', [PesananController::class, 'selesaikan'])->name('pesanan.selesaikan');
});

Route::middleware([AuthPelanggan::class])->group(function () {
    // Halaman daftar alamat
    Route::get('/alamat', [AlamatController::class, 'index'])->name('alamat.index');

    // Halaman form create alamat
    Route::get('/alamat/create', [AlamatController::class, 'create'])->name('alamat.create');

    // Menyimpan alamat baru
    Route::post('/alamat', [AlamatController::class, 'store'])->name('alamat.store');

    // Halaman form edit alamat
    Route::get('alamat/{id_alamat}/edit', [AlamatController::class, 'edit'])->name('alamat.edit');

    // Mengupdate alamat
    Route::put('alamat/{id_alamat}', [AlamatController::class, 'update'])->name('alamat.update');

    // Menghapus alamat
    Route::delete('alamat/{id_alamat}', [AlamatController::class, 'destroy'])->name('alamat.destroy');
});

Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
Route::get('/toko/{id_penjual}', [TokoController::class, 'show'])->name('toko.detail');



Route::get('/kategori/{id_kategori}/produks', [ProdukController::class, 'productsByCategory'])->name('kategori.produks');
