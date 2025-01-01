<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamat;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    // Menampilkan daftar alamat
    public function index()
    {
        $user = Auth::user();
        $alamats = Alamat::where('id_user', $user->id_user)->get();
        return view('alamat-index', compact('alamats'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('alamat-create');
    }

    // Menyimpan data alamat baru
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

        // Mengupdate alamat default jika ada
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

    // Menampilkan form edit alamat
    public function edit($id_alamat)
{
    $alamat = Alamat::findOrFail($id_alamat);
    return view('alamat-edit', compact('alamat'));
}

public function update(Request $request, $id_alamat)
{
    $request->validate([
        'alamat' => 'required|string',
        'kecamatan' => 'required|string',
        'kota' => 'required|string',
        'provinsi' => 'required|string',
        'kode_pos' => 'required|string|max:10',
    ]);

    $alamat = Alamat::findOrFail($id_alamat);
    $alamat->update([
        'alamat' => $request->alamat,
        'kecamatan' => $request->kecamatan,
        'kota' => $request->kota,
        'provinsi' => $request->provinsi,
        'kode_pos' => $request->kode_pos,
        'is_default' => $request->has('is_default'),
    ]);

    return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diperbarui!');
}


    // Menghapus alamat
    public function destroy($id_alamat)
    {
        $alamat = Alamat::findOrFail($id_alamat);
        $alamat->delete();

        return redirect()->route('dashboard-pelanggan')->with('success', 'Alamat berhasil dihapus!');
    }
}
