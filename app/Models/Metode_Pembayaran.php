<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Metode_Pembayaran extends Model
{
    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_metode', 'id_metode');
    }
}
