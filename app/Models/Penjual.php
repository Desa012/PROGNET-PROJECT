<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penjual extends Model
{
    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_penjual', 'id_penjual');
    }
}
