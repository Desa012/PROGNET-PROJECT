<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        // Cari penjual berdasarkan nama_toko dan muat produk terkait
        $penjuals = Penjual::where('nama_toko', 'like', '%' . $searchQuery . '%')
            ->with('produks')  // Menambahkan produk terkait
            ->get();

        return view('toko-index', compact('penjuals'));
    }
}
