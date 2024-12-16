<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori_Produk;

class DashboardPelangganController extends Controller
{
    public function index()
{
    // Ambil semua kategori beserta produk di dalamnya
    $kategoriProduks = Kategori_Produk::with('produks')->get();

    return view('dashboard-pelanggan', compact('kategoriProduks'));
}

}
