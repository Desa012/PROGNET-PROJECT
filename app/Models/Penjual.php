<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Penjual extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'penjuals';
    protected $primaryKey = 'id_penjual';
    protected $fillable = [
        'nama_penjual',
        'deskripsi_toko',
        'email',
        'password_toko',
    ];

    protected $hidden = [
        'password_toko',
        'remember_token',
    ];

    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_penjual', 'id_penjual');
    }
}
