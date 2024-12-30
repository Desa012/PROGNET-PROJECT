<?php

namespace App\Http\Controllers;

use App\Models\Metode_Pembayaran;
use Illuminate\Http\Request;

class MetodePembayaran extends Controller
{
    public function index()
    {
        return Metode_Pembayaran::all();
    }
}
