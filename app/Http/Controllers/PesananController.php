<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Metode_Pembayaran;
use App\Models\Alamat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $keranjangs = Keranjang::where('id_user', $user)->with('produks')->get();
        $total_harga = $keranjangs->sum(function ($item) {
            return $item->produks->harga * $item->jumlah;
        });

        return view('pesanan-index', compact('keranjangs', 'total_harga'));
    }

    public function create()
    {
        // Ambil produk di keranjang berdasarkan id_pelanggan dan id_keranjang
        $user = auth()->user();

        $keranjangs = Keranjang::where('id_user', $user->id_user)
            ->with('produks')
            ->get();

        // Hitung total harga
        $total_harga = $keranjangs->sum(function ($keranjang) {
            return $keranjang->produks->harga * $keranjang->jumlah;
        });

        // Ambil metode pembayaran
        $metode_pembayaran = Metode_Pembayaran::all();

        $toko = Auth::user()->penjuals->id_penjual;

        //Ambil alamat pelanggan
        $alamats = Alamat::where('id_user', $user->id_user)->get() ?? 'Alamat Belum Diatur';

        return view('pesanan-create', compact('keranjangs', 'alamats', 'total_harga', 'metode_pembayaran', 'toko'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'id_alamat' => 'required|exists:alamats,id_alamat',
            'total_harga' => 'required|numeric',
            'metode_pembayaran' => 'required|exists:metode_pembayarans,id_metode',
        ]);

        $user = Auth::user();

        $pesanan = Pesanan::create([
            'id_user' => $user->id_user,
            'id_penjual' => $user->penjuals->id_penjual,
            'id_alamat' => $request->id_alamat,
            'id_metode' => $request->metode_pembayaran,
            'tanggal_pesanan' => Carbon::now(),
            'total_harga' => $request->total_harga,
            'status' => 'Sudah Bayar',
        ]);


        // Menambahkan produk ke dalam pesanan
        $keranjangs = Keranjang::where('id_user', $user->id_user)->with('produks')->get();
        foreach ($keranjangs as $produk) {
            $pesanan->detail_pesanans()->create([
                'id_produk' => $produk->id_produk,
                'jumlah' => $produk->jumlah,
                'subtotal' => $produk->produks->harga * $produk->jumlah,
            ]);
        }

        // Kosongkan keranjang setelah pemesanan
        Keranjang::where('id_user', $user->id_user)->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat');
    }

}
