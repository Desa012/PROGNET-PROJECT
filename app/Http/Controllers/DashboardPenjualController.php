<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;


class DashboardPenjualController extends Controller
{
    public function index()
    {
        // Ambil produk yang ingin ditampilkan di dashboard (misalnya 5 produk terbaru)
        $penjualId = auth()->guard('penjual')->id(); // Mendapatkan ID penjual dari session
        $produk = Produk::where('id_penjual', $penjualId)->get();

        // Hitung total produk
        $totalProduk = Produk::where('id_penjual', $penjualId)->count();
        
        return view('dashboard-penjual', compact('produk', 'totalProduk')); // Kirim data produk ke view
    }
}
