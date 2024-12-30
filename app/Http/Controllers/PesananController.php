<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Metode_Pembayaran;
use Carbon\Carbon;
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

        return view('pesanan-index', compact('keranjangs', 'total_harga'));
    }

    public function create()
    {
        // Ambil produk di keranjang berdasarkan id_pelanggan dan id_keranjang
        $pelanggan = auth()->guard('pelanggan')->user();
        $keranjangs = Keranjang::where('id_pelanggan', $pelanggan->id_pelanggan)
            ->with('produks')
            ->get();
        // $keranjangs = Keranjang::join('produks', 'keranjangs.id_produk', '=', 'produks.id_produk')
        //     ->where('keranjangs.id_pelanggan', $pelanggan)
        //     ->where('keranjangs.id_keranjang', $keranjang_id)
        //     ->select('keranjangs.*', 'produks.nama_produk', 'produks.harga', 'produks.gambar_produk')
        //     ->firstOrFail();




        // dd($keranjangs);

        // Hitung total harga
        $total_harga = $keranjangs->sum(function ($keranjang) {
            return $keranjang->produks->harga * $keranjang->jumlah;
        }); // Sesuaikan sesuai kebutuhan

        // Ambil metode pembayaran
        $metode_pembayaran = Metode_Pembayaran::all();

        //Ambil alamat pelanggan
        $alamat = $pelanggan->alamat ?? 'Alamat Belum Diatur';

        return view('pesanan-create', compact('keranjangs', 'alamat', 'total_harga', 'metode_pembayaran'));
    }

    // public function create($keranjang_id)
    // {
    //     // Ambil produk di keranjang berdasarkan id_pelanggan dan id_keranjang
    //     $pelanggan = auth()->guard('pelanggan')->id();
    //     $keranjangs = Keranjang::where('id_pelanggan', $pelanggan)
    //         ->where('id_keranjang', $keranjang_id)
    //         ->with('produks')
    //         ->get();
    //     // $keranjangs = Keranjang::join('produks', 'keranjangs.id_produk', '=', 'produks.id_produk')
    //     //     ->where('keranjangs.id_pelanggan', $pelanggan)
    //     //     ->where('keranjangs.id_keranjang', $keranjang_id)
    //     //     ->select('keranjangs.*', 'produks.nama_produk', 'produks.harga', 'produks.gambar_produk')
    //     //     ->firstOrFail();


    //     // dd($keranjangs);

    //     // Hitung total harga
    //     $total_harga = $keranjangs->sum(function ($keranjang) {
    //         return $keranjang->produks->harga * $keranjang->jumlah;
    //     }); // Sesuaikan sesuai kebutuhan

    //     // Ambil metode pembayaran
    //     $metode_pembayaran = Metode_Pembayaran::all();

    //     return view('pesanan-create', compact('keranjangs', 'total_harga', 'metode_pembayaran'));
    // }


    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        // Membuat pesanan baru
        $pesanan = new Pesanan();
        $pesanan->id_pelanggan = auth()->guard('pelanggan')->id();
        $pesanan->tanggal_pesanan = Carbon::now(); // Tanggal dan waktu saat ini
        $pesanan->total_harga = $request->total_harga;
        $pesanan->id_metode = $request->metode_pembayaran;
        $pesanan->status = 'sudah bayar'; // status bisa berbeda sesuai kebutuhan
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
