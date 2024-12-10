<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produks';

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_penjual', 'id_kategori', 'id_diskon', 'nama_produk', 
        'deskripsi_produk', 'gambar_produk', 'harga', 'stok'
    ];

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

    // Add methods to handle the product image, pricing, etc.
    public function getGambarProdukUrlAttribute()
    {
        return asset('storage/' . $this->gambar_produk);
    }

    // Optional: Add a method to calculate the price after discount (if applicable)
    public function hargaSetelahDiskon()
    {
        if ($this->diskon) {
            $diskon = $this->diskon->persentase_diskon;
            return $this->harga - ($this->harga * ($diskon / 100));
        }
        return $this->harga;
    }
}
