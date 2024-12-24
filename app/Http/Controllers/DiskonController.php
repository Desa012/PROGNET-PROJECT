<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\Produk;
use App\Models\Kategori_Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualId = auth()->guard('penjual')->id();
        $diskon = Diskon::where('id_penjual', $penjualId)->get();
        return view('diskons', compact('diskon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori_Produk::all();
        $produk = Produk::all();
        return view('diskon-create', compact('kategori', 'produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'persentase_diskon' => 'required|numeric|min:0|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Dapatkan id_penjual dari autentikasi
        $penjualId = auth()->guard('penjual')->id();

        // Simpan diskon dengan menambahkan id_penjual
        $diskon = Diskon::create([
            'nama_diskon' => $request->nama_diskon,
            'persentase_diskon' => $request->persentase_diskon,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'id_penjual' => $penjualId, // Tambahkan id_penjual
        ]);

        // Logika untuk kategori produk dan produk
        if ($request->kategori_produk) {
            $produkKategori = Produk::where('id_kategori', $request->kategori_produk)->pluck('id_produk');
            $diskon->produk()->attach($produkKategori);
        }

        if ($request->has('produk')) {
            $diskon->produk()->attach($request->produk);
        }

        return redirect()->route('diskons.index')->with('success', 'Diskon berhasil ditambahkan.');
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
    public function edit(string $id_diskon)
    {
        $diskon =  Diskon::find($id_diskon);
        return view('diskon-edit', compact('diskon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_diskon)
    {
        $diskon = Diskon::find($id_diskon);

        $diskon->nama_diskon = $request['nama_diskon'];
        $diskon->persentase_diskon = $request['persentase_diskon'];
        $diskon->tanggal_mulai = $request['tanggal_mulai'];
        $diskon->tanggal_selesai = $request['tanggal_selesai'];

        $diskon->save();

        return redirect()->route('diskons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_diskon)
    {
        $diskon = Diskon::find($id_diskon);
        $diskon->delete();
        return redirect()->route('diskons.index');
    }
}
