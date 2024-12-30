<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Metode_Pembayaran extends Model
{

    protected $table = 'metode_pembayarans';

    protected $primaryKey = 'id_metode';

    protected $fillable = [
        'jenis metode',
        'deskripsi',
    ];

    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_metode', 'id_metode');
    }
}
