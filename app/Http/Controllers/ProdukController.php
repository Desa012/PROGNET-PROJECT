<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjual;
use App\Models\Kategori_Produk;
use App\Models\Diskon;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all(); // Ambil semua produk
        return view('produks', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penjuals = Penjual::all(); // Ambil semua penjual
        $kategoriProduks = Kategori_Produk::all(); // Ambil semua kategori produk
        $diskons = Diskon::all(); // Ambil semua diskon
        return view('produk-create', compact('penjuals', 'kategoriProduks', 'diskons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_penjual' => 'required|exists:penjuals,id_penjual',
            'id_kategori' => 'required|exists:kategori_produks,id_kategori',
            'id_diskon' => 'required|exists:diskons,id_diskon',
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar_produk')) {
            $imageName = time() . '.' . $request->gambar_produk->extension();
            $request->gambar_produk->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        // Simpan produk baru
        $produk = new Produk();
        $produk->id_penjual = $request->id_penjual;
        $produk->id_kategori = $request->id_kategori;
        $produk->id_diskon = $request->id_diskon;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->gambar_produk = $imageName;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        $produk->save();

        return redirect()->route('produks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_produk)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_produk)
    {
        $produk = Produk::find($id_produk);
        $penjuals = Penjual::all();
        $kategoriProduks = Kategori_Produk::all();
        $diskons = Diskon::all();
        return view('produk-edit', compact('produk', 'penjuals', 'kategoriProduks', 'diskons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_produk)
    {
        // Validasi input
        $request->validate([
            'id_kategori' => 'required|exists:kategori_produks,id_kategori',
            'id_diskon' => 'required|exists:diskons,id_diskon',
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
        $produk->id_diskon = $request->id_diskon;
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
}
