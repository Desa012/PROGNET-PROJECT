<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjual;
use App\Models\Kategori_Produk;
use App\Models\Diskon;
use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toko = Auth::user()->penjuals;
        $produk = Produk::where('id_penjual', $toko->id_penjual)
            ->with('diskon') // Eager load relasi diskon
            ->get();
        return view('produks', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penjuals = Penjual::all(); // Ambil semua penjual
        $kategoriProduks = Kategori_Produk::all(); // Ambil semua kategori produk
        return view('produk-create', compact('penjuals', 'kategoriProduks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_kategori' => 'required|exists:kategori_produks,id_kategori',
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        // Ambil ID Penjual dari sesi login
        $toko = Auth::user()->penjuals->id_penjual;

        // Upload gambar jika ada
        $imageName = null;
        if ($request->hasFile('gambar_produk')) {
            $imageName = time() . '.' . $request->gambar_produk->extension();
            $request->gambar_produk->move(public_path('images'), $imageName);
        }

        // Simpan produk baru
        $produk = new Produk();
        $produk->id_penjual = $toko; // Gunakan ID penjual dari sesi login
        $produk->id_kategori = $request->id_kategori;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->gambar_produk = $imageName;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        $produk->save();

        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id_produk)
    {
        $produk = Produk::with(['diskon', 'penjual'])->findOrFail($id_produk);

        return view('produk-show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function productsByCategory($id_kategori)
    {
        // Cari kategori berdasarkan ID
        $kategori = Kategori_Produk::with('produks.diskon')->findOrFail($id_kategori);

        // Ambil produk yang terkait dengan kategori ini
        $produks = $kategori->produks;

        foreach ($produks as $produk) {

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

        return view('produk-kategori', compact('kategori', 'produks'));
    }

    public function edit(string $id_produk)
    {
        $produk = Produk::find($id_produk);
        $penjuals = Penjual::all();
        $kategoriProduks = Kategori_Produk::all();
        return view('produk-edit', compact('produk', 'penjuals', 'kategoriProduks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_produk)
    {
        // Validasi input
        $request->validate([
            'id_kategori' => 'required|exists:kategori_produks,id_kategori',
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        // Cari produk berdasarkan ID
        $produk = Produk::find($id_produk);

        // Update gambar jika ada
        if ($request->hasFile('gambar_produk')) {
            $imageName = time() . '.' . $request->gambar_produk->extension();
            $request->gambar_produk->move(public_path('images'), $imageName);
            $produk->gambar_produk = $imageName;
        }

        // Update data produk
        $produk->id_kategori = $request->id_kategori;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        $produk->save();

        return redirect()->route('produks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_produk)
    {
        $produk = Produk::find($id_produk);
        $produk->delete();
        return redirect()->route('produks.index');
    }

    public function produk_detail(string $id_produk) {
        $produk = Produk::with(['diskon', 'penjual'])->findOrFail($id_produk);

        return view('produk-show', compact('produk'));
    }
}
