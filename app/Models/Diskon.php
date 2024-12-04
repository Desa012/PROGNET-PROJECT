<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diskon extends Model
{
    // Nama tabel
    protected $table = 'diskons';

    // Primary key
    protected $primaryKey = 'id_diskon';

    public function produk(): hasMany
    {
        return $this->hasMany(Produk::class, 'id_diskon', 'id_diskon');
    }
}
