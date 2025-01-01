<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Diskon;
use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukDetailController extends Controller
{
    public function produk_detail(string $id_produk)
    {
        $produk = Produk::with(['diskon', 'penjual.alamats'])->findOrFail($id_produk);

        return view('produk-show', compact('produk'));
    }
}
