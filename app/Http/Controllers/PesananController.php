<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Metode_Pembayaran;
use App\Models\Alamat;
use App\Models\Pengiriman;
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

        $pesanans = Pesanan::with(['detail_pesanans.produk', 'pengiriman', 'metode_pembayaran'])
            ->where('id_user', $user)
            ->orderBy('tanggal_pesanan', 'desc')
            ->get();

        return view('pesanan-index', compact('keranjangs', 'total_harga', 'pesanans'));
    }

    public function create()
    {
        // Ambil produk di keranjang berdasarkan id_pelanggan dan id_keranjang
        $user = auth()->user();

        $keranjangs = Keranjang::where('id_user', $user->id_user)
            ->with('produks.diskon')
            ->get();


        // Hitung total harga
        $total_harga = $keranjangs->sum(function ($keranjang) {

            // dd($keranjang->produks->diskon->first()->persentase_diskon);
            $harga_diskon = $keranjang->produks->diskon->isNotEmpty()
            ? $keranjang->produks->harga - ($keranjang->produks->harga * $keranjang->produks->diskon->first()->persentase_diskon / 100)
            : $item->produks->harga;

            return $harga_diskon * $keranjang->jumlah;
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
        $saldo_user = $user->saldo;
        if ($saldo_user < $request->total_harga) {
            return redirect()->back()->withErrors(['saldo' => 'Saldo tidak mencukupi']);
        } else {
            $kurang_saldo = $saldo_user - $request->total_harga;
            $user->saldo = $kurang_saldo;
            $user->save();
        }

        // Ambil keranjang pengguna
        $keranjangs = Keranjang::where('id_user', $user->id_user)->with('produks.penjual')->get();

        // Pastikan keranjang tidak kosong
        if ($keranjangs->isEmpty()) {
            return redirect()->back()->withErrors(['keranjang' => 'Keranjang Anda kosong.']);
        }

        // Ambil penjual dari produk pertama di keranjang
        $penjual = $keranjangs->first()->produks->penjual;


        $pesanan = Pesanan::create([
            'id_user' => $user->id_user,
            'id_penjual' => $penjual->id_penjual,
            'id_alamat' => $request->id_alamat,
            'id_metode' => $request->metode_pembayaran,
            'tanggal_pesanan' => Carbon::now('Asia/Singapore'),
            'total_harga' => $request->total_harga,
            'status' => 'Sudah Bayar',
        ]);


        // Menambahkan produk ke dalam pesanan

        foreach ($keranjangs as $keranjang) {
            $produk = $keranjang->produks;

            // Periksa apakah stok cukup
            if ($produk->stok < $keranjang->jumlah) {
                return redirect()->back()->withErrors(['stok' => "Stok untuk produk {$produk->nama_produk} tidak mencukupi."]);
            }

            // Kurangi stok produk
            $produk->stok -= $keranjang->jumlah;
            $produk->save();

            $diskon = $produk->diskon->first();
            $harga_diskon = $diskon
                ? $produk->harga - ($produk->harga * $diskon->persentase_diskon / 100)
                : $produk->harga;

            // Tambahkan detail pesanan
            $pesanan->detail_pesanans()->create([
                'id_produk' => $produk->id_produk,
                'jumlah' => $keranjang->jumlah,
                'subtotal' => $harga_diskon * $keranjang->jumlah,
            ]);
        }

        $pengiriman = Pesanan::find($pesanan->id_pesanan)->pengiriman();
        $pengiriman->create([
            'id_pesanan' => $pesanan->id_pesanan,
            'status_pengiriman' => 'dikemas',
        ]);


        // Kosongkan keranjang setelah pemesanan
        Keranjang::where('id_user', $user->id_user)->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan telah dibuat.');
    }

    public function kelolaPesanan()
    {
        $penjual = Auth::user()->penjuals;

        // Ambil semua pesanan untuk penjual
        $pesananBelumSelesai = Pesanan::where('id_penjual', $penjual->id_penjual)
            ->whereHas('pengiriman', function ($query) {
                $query->where('status_pengiriman', '!=', 'selesai');
            })
            ->with(['users', 'alamats', 'detail_pesanans.produk', 'pengiriman'])
            ->get();

        return view('kelola-pesanan', compact('pesananBelumSelesai'));
    }

    public function riwayatPesanan()
    {
        $penjual = Auth::user()->penjuals;

        $pesananSelesai = Pesanan::where('id_penjual', $penjual->id_penjual)
            ->whereHas('pengiriman', function ($query) {
                $query->where('status_pengiriman', 'selesai');
            })
            ->with(['users', 'alamats', 'detail_pesanans.produk', 'pengiriman'])
            ->get();

        return view('riwayat-pesanan', compact('pesananSelesai'));
    }

    public function detailRiwayat($id_pesanan)
    {
        $penjual = Auth::user()->penjuals;

        $pesananSelesai = Pesanan::where('id_penjual', $penjual->id_penjual)
            ->with(['users', 'alamats', 'detail_pesanans.produk', 'pengiriman'])->where('id_pesanan', $id_pesanan)
            ->get();

        $pesanan = Pesanan::where('id_penjual', $penjual->id_penjual)
            ->whereHas('pengiriman', function ($query) {
                $query->where('status_pengiriman', 'selesai');
            })
            ->with(['users', 'alamats', 'detail_pesanans.produk', 'pengiriman'])->findOrFail($id_pesanan);

        return view('detail-riwayat', compact('pesananSelesai', 'pesanan'));
    }

    public function updatePengiriman(Request $request, $id)
    {
        $request->validate([
            'status_pengiriman' => 'required|in:dikemas,dikirim,selesai',
        ]);

        $pengiriman = Pengiriman::firstOrNew(['id_pesanan' => $id]);
        $pengiriman->tanggal_pengiriman = Carbon::now('Asia/Singapore');
        $pengiriman->status_pengiriman = $request->status_pengiriman;

        $pengiriman->save();

        return redirect()->back()->with('success', 'Pengiriman berhasil diperbarui.');
    }

    public function show($id_pesanan)
    {
        $pesanan = Pesanan::with(['detail_pesanans.produk', 'pengiriman'])->findOrFail($id_pesanan);

        return view('detail-pesanan', compact('pesanan'));
    }

    public function selesaikan($id_pesanan)
    {
        // Cari pesanan berdasarkan ID
        $pesanan = Pesanan::with('pengiriman')->get()->findOrFail($id_pesanan);

        // Pastikan status saat ini sudah bayar sebelum mengubah ke selesai
        if ($pesanan->status === 'sudah bayar') {
            // Update status di tabel pengirimans
            $pengiriman = $pesanan->pengiriman;
            $pengiriman->status_pengiriman = 'selesai';
            $pengiriman->tanggal_diterima = Carbon::now('Asia/Singapore');
            $pengiriman->save();

            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil selesai.');
        }

        return redirect()->back()->with('error', 'Status pesanan harus sudah bayar sebelum selesai.');
    }
}
