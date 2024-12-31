<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    // Menentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'pesanans';

    protected $primaryKey = 'id_pesanan';

    protected $dates = ['tanggal_pesanan'];

    protected $casts = [
        'tanggal_pesanan' => 'datetime',
    ];

    // Definisi kolom yang dapat diisi massal
    protected $fillable = [
        'id_user',
        'id_penjual',
        'id_alamat',
        'id_metode',
        'tanggal_pesanan',
        'status',
        'total_harga'
    ];

    // Relasi dengan model Pelanggan
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function penjual(): BelongsTo
    {
        return $this->belongsTo(Penjual::class, 'id_penjual');
    }

    // Relasi dengan model Detail_Pesanan
    public function detail_pesanans(): HasMany
    {
        return $this->hasMany(Detail_Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    // Relasi dengan model Pengiriman
    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class, 'id_pesanan', 'id_pesanan');
    }

    // Relasi dengan model Metode_Pembayaran
    public function metode_pembayaran(): BelongsTo
    {
        return $this->belongsTo(Metode_Pembayaran::class, 'id_metode', 'id_metode');
    }

    public function alamats(): BelongsTo
    {
        return $this->belongsTo(Alamat::class, 'id_alamat');
    }
}
