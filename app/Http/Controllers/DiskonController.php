<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diskon = Diskon::all();
        return view('diskons', compact('diskon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('diskon-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newDiskon = new Diskon();
        $newDiskon->nama_diskon = $request['nama_diskon'];
        $newDiskon->persentase_diskon = $request['persentase_diskon'];
        $newDiskon->tanggal_mulai = $request['tanggal_mulai'];
        $newDiskon->tanggal_selesai = $request['tanggal_selesai'];
        $newDiskon->save();

        return redirect()->route('diskons.index');
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
