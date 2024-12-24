<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = auth()->guard('pelanggan')->id();
        $keranjangs = Keranjang::where('id_pelanggan', $pelanggan)->with('produks')->get();
        return view('keranjang-index', compact('keranjangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::all();
        return view('keranjangs.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produks,id_produk',
            'jumlah' => 'required|integer|min:1',
        ]);

        $id_produk = $request->id_produk;
        $pelanggan = auth()->guard('pelanggan')->id();

        if (!$pelanggan) {
            return redirect()->route('login-pelanggan');
        }

        $item_keranjang = Keranjang::where('id_pelanggan', $pelanggan)->where('id_produk', $id_produk)->first();

        if ($item_keranjang) {
            $item_keranjang->jumlah += $request->jumlah;
            $item_keranjang->save();
        } else {
            Keranjang::create([
                'id_pelanggan' => $pelanggan,
                'id_produk' => $id_produk,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect()->route('keranjangs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $keranjang = Keranjang::with('produks')->findOrFail($id);
        return view('keranjangs.show', compact('keranjang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $produks = Produk::all();
        return view('keranjangs.edit', compact('keranjang', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_produk' => 'required|exists:produks,id_produk',
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->update([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
        ]);
        //    $keranjang->save();

        $total_harga = $keranjang->produks->harga * $keranjang->jumlah;

        $total_harga_keranjang = Keranjang::where('id_pelanggan', auth()->guard('pelanggan')->id())->with('produks')->get()->sum(function ($item) {
            return $item->produks->harga * $item->jumlah;
        });

        $formatted_total_harga_keranjang = number_format($total_harga_keranjang, 0, ',', '.');

        return response()->json([
            'total_harga' => number_format($total_harga, 0, ',', '.'),
            'total_harga_keranjang' => $formatted_total_harga_keranjang,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();
        return redirect()->route('keranjangs.index');
    }
}
