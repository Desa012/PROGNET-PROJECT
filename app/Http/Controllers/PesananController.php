<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Metode_Pembayaran;
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
    public function create($keranjangId)
    {
        // Ambil produk di keranjang berdasarkan id_pelanggan dan keranjangId
        $keranjang = Keranjang::where('id_pelanggan', auth()->id())
            ->where('id', $keranjangId)
            ->with('produk')
            ->firstOrFail();

        // Hitung total harga
        $totalHarga = $keranjang->produk->sum('harga'); // Sesuaikan sesuai kebutuhan

        // Ambil metode pembayaran
        $metodePembayaran = Metode_Pembayaran::all();

        return view('pesanan.create', compact('keranjang', 'totalHarga', 'metodePembayaran'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        // Membuat pesanan baru
        $pesanan = new Pesanan();
        $pesanan->user_id = auth()->id();
        $pesanan->alamat = $request->alamat;
        $pesanan->metode_pembayaran = $request->metode_pembayaran;
        $pesanan->status = 'menunggu'; // status bisa berbeda sesuai kebutuhan
        $pesanan->save();

        // Menambahkan produk ke dalam pesanan
        $keranjang = session('keranjang', []);
        foreach ($keranjang as $produk) {
            $pesanan->detailPesanan()->create([
                'produk_id' => $produk->id,
                'jumlah' => 1, // Sesuaikan jumlah produk
                'harga' => $produk->harga,
            ]);
        }

        // Kosongkan keranjang setelah pemesanan
        session()->forget('keranjang');

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat');
    }

}
