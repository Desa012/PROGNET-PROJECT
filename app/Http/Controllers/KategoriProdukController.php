<?php

namespace App\Http\Controllers;

use App\Models\Kategori_Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KategoriProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori_Produk::all();
        return view('kategori_produks', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori_produk-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newKategori = new Kategori_Produk();

        $newKategori->nama_kategori = $request['nama_kategori'];


        $newKategori->save();

        return redirect()->route('kategori_produks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori =  Kategori_Produk::find($id);
        return view('kategori_produk-edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori_Produk::find($id);

        $kategori->nama_kategori = $request['nama_kategori'];

        $kategori->save();

        return redirect()->route('kategori_produks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori_Produk::find($id);
        $kategori->delete();
        return redirect()->route('kategori_produks.index');
    }
}
