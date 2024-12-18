<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pelanggan = auth()->guard('pelanggan')->id();
        $keranjangs = Keranjang::where('id_pelanggan', $pelanggan)->with('produks')->get();
        $total_harga = $keranjangs->sum(function ($item) {
            return $item->produks->harga * $item->jumlah;
        });

        return view('pesanan.index', compact('keranjangs', 'total_harga'));
    }

    // public function store(Request $request)
    // {
    //     $pelanggan = auth()->guard('pelanggan')->id();
    //     $keranjangs = Keranjang::where('id_pelanggan', $pelanggan)-with('produks')->get();

    //     $request->validate([
    //         'alamat'
    //     ])
    // }
}
