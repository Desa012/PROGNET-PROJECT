<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    // Menentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'pesanans';

    protected $dates = ['tanggal_pesanan'];


    // Definisi kolom yang dapat diisi massal
    protected $fillable = ['id_pelanggan', 'tanggal_pesanan', 'status', 'total_harga'];

     // Relasi dengan model Pelanggan
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    // Relasi dengan model Detail_Pesanan
    public function detail_pesanans(): HasMany
    {
        return $this->hasMany(Detail_Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    // Relasi dengan model Pengiriman
    public function pengiriman(): BelongsTo
    {
        return $this->belongsTo(Pengiriman::class, 'id_pesanan', 'id_pesanan');
    }

    // Relasi dengan model Metode_Pembayaran
    public function metode_pembayaran(): BelongsTo
    {
        return $this->belongsTo(Metode_Pembayaran::class, 'id_metode', 'id_metode');
    }
}
