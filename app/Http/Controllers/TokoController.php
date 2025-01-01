<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use App\Models\Alamat;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        // Cari penjual berdasarkan nama_toko dan muat produk terkait
        $penjuals = Penjual::where('nama_toko', 'like', '%' . $searchQuery . '%')
            ->with('produks', 'alamats')  // Menambahkan produk terkait
            ->get();

        return view('toko-index', compact('penjuals'));
    }

    public function show($id_penjual)
    {
        $penjual = Penjual::with('produks')->where('id_penjual', $id_penjual)->firstOrFail();


        $alamat_default = Alamat::where('id_user', $penjual->id_user)->where('is_default', 1)->first();

        return view('toko-detail', compact('penjual', 'alamat_default'));
    }
}
