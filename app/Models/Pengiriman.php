<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengirimans'; // Pastikan nama tabel sesuai dengan database

    protected $fillable = [
        'id_pesanan',
        'status_pengiriman',
        'tanggal_pengiriman',
        'tanggal_diterima',
        'no_resi',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
