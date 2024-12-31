<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori_Produk;
use App\Models\Produk;
use App\Models\Alamat;
use Illuminate\Support\Facades\Auth;

class DashboardPelangganController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua kategori beserta produk di dalamnya
        $kategoriProduks = Kategori_Produk::with('produks')->get();

        // Cek pengguna ada toko
        $toko = $user->penjuals;

        $produk = Produk::with('diskon')->get();

        foreach ($kategoriProduks as $kategori) {
            foreach ($kategori->produks as $produk) {

                $penjual = $produk->penjual;

                if ($penjual) {
                    $alamat_default = Alamat::where('id_user', $penjual->id_user)->where('is_default', 1)->first();

                    if ($alamat_default) {
                        $produk->alamat_penjual = collect([
                            'alamat' => $alamat_default->alamat,
                            'kota' => $alamat_default->kota,
                        ]);
                    }
                }
            }
        }

        return view('dashboard-pelanggan', compact('kategoriProduks', 'user', 'toko', 'produk'));
    }

    public function tambahKeKeranjang(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_produk' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Ambil data keranjang dari session (jika ada)
        $keranjang = session()->get('keranjang', []);

        $id_produk = $request->id_produk;

        // Cek apakah produk sudah ada di keranjang
        if (isset($keranjang[$id_produk])) {
            // Tambahkan jumlah jika produk sudah ada
            $keranjang[$id_produk]['jumlah'] += $request->jumlah;
        } else {
            // Tambahkan produk baru ke keranjang
            $keranjang[$id_produk] = [
                'id_produk' => $id_produk,
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'jumlah' => $request->jumlah,
            ];
        }

        // Simpan kembali ke session
        session()->put('keranjang', $keranjang);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Melihat isi keranjang
    public function lihatKeranjang()
    {
        // Ambil keranjang dari session
        $keranjang = session()->get('keranjang', []);

        return view('keranjang', compact('keranjang'));
    }
}
