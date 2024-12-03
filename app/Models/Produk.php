<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    public function penjual(): BelongsTo
    {
        return $this->belongsTo(Penjual::class, 'id_penjual');
    }

    public function kategori_produk(): BelongsTo
    {
        return $this->belongsTo(Kategori_Produk::class, 'id_kategori');
    }

    public function diskon(): BelongsTo
    {
        return $this->belongsTo(Diskon::class, 'id_diskon');
    }

    public function detail_pesanans(): HasMany
    {
        return $this->hasMany(Detail_Pesanan::class, 'id_produk', 'id_produk');
    }

    public function ulasans(): HasMany
    {
        return $this->hasMany(Ulasan::class, 'id_produk', 'id_produk');
    }
}
