<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Keranjang extends Model
{
    protected $table = 'keranjangs';

    // Primary key
    protected $primaryKey = 'id_keranjang';

    protected $fillable = [
        'id_pelanggan',
        'id_produk',
        'jumlah',
    ];

    public function produks(): belongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function pelanggans(): belongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
