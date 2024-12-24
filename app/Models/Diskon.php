<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diskon extends Model
{
    // Nama tabel
    protected $table = 'diskons';

    protected $fillable = [
        'id_penjual',
        'nama_diskon',
        'persentase_diskon',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    // Primary key
    protected $primaryKey = 'id_diskon';

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'produk_diskon', 'id_diskon', 'id_produk');
    }

    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'id_penjual', 'id_penjual');
    }
}
