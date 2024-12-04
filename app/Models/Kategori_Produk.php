<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori_Produk extends Model
{
    protected $table = 'kategori_produks';

    // Primary key
    protected $primaryKey = 'id_kategori';


    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id_kategori');
    }
}
