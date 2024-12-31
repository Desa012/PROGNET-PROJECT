<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamat;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    public function create()
    {
        return view('alamat-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string|max:10',
        ]);

        $user = Auth::user();

        if ($request->has('is_default')) {
            Alamat::where('id_user', $user->id_user)->update(['is_default' => false]);
        }

        Alamat::create([
            'id_user' => $user->id_user,
            'alamat' => $request->alamat,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'is_default' => $request->has('is_default'),
        ]);

        return redirect()->route('dashboard-pelanggan')->with('success', 'Alamat berhasil ditambahkan!');
    }
}
