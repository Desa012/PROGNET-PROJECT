<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Diskon extends Model
{
    public function produk(): hasMany
    {
        return $this->hasMany(Produk::class, 'id_diskon', 'id_diskon');
    }
}
