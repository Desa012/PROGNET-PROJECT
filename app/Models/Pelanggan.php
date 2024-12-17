<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = [
        'nama_pelanggan',
        'email',
        'password_pelanggan',
        'alamat',
    ];

    protected $hidden = [
        'password_pelanggan',
        'remember_token',
    ];

    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function keranjangs(): HasMany
    {
        return $this->hasMany(Keranjang::class, 'id_pelanggan', 'id_pelanggan');
    }
}

