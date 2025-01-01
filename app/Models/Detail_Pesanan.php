<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Detail_Pesanan extends Model
{
    protected $table = 'detail_pesanans';

    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_pesanan',
        'id_produk',
        'jumlah',
        'subtotal',
    ];

    public function pesanan(): belongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    public function produk(): belongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
