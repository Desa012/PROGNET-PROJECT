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
        'id_user',
        'nama_toko',
        'deskripsi_toko',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_penjual', 'id_penjual');
    }

    public function diskon()
    {
        return $this->hasMany(Diskon::class, 'id_penjual', 'id_penjual');
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_penjual', 'id_penjual');
    }

    public function alamats()
    {
        return $this->hasMany(Alamat::class, 'id_user', 'id_user');
    }
}
