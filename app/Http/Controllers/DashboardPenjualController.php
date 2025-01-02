<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class DashboardPenjualController extends Controller
{
    public function index()
    {
        // Ambil data toko menggunakan relasi ke penjual
        $toko = Auth::user()->penjuals;

        if (!$toko) {
            return redirect()->route('dashboard-pelanggan')->withErrors('Anda belum memiliki toko.');
        }

        // Ambil produk yang ingin ditampilkan di dashboard 
        $produk = Produk::where('id_penjual', $toko->id_penjual)
            ->with('diskon') // Eager load relasi diskon
            ->get();

        // Hitung total produk
        $totalProduk = Produk::where('id_penjual', $toko->id_penjual)->count();

        // Total pesanan selesai
        $pesananSelesai = Pesanan::where('id_penjual', $toko->id_penjual)
            ->whereHas('pengiriman', function ($query) {
                $query->where('status_pengiriman', 'selesai');
            })->count();

        // Total pesanan belum selesai
        $pesananBelumSelesai = Pesanan::where('id_penjual', $toko->id_penjual)
            ->whereHas('pengiriman', function ($query) {
                $query->whereIn('status_pengiriman', ['dikemas', 'dikirim']);
            })->count();

        $pesanan = Pesanan::where('id_penjual', $toko->id_penjual)->with('users')->get();

        $totalPendapatan = Pesanan::where('id_penjual', $toko->id_penjual)
            ->where('status', 'sudah bayar')
            ->sum('total_harga');

        return view('dashboard-penjual', compact('produk', 'totalProduk', 'pesanan', 'toko', 'totalPendapatan', 'pesananSelesai', 'pesananBelumSelesai')); // Kirim data produk ke view
    }
}
