<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Alamat extends Model
{
    protected $primaryKey = 'id_alamat';

    protected $fillable = [
        'id_user',
        'alamat',
        'kecamatan',
        'kota',
        'provinsi',
        'kode_pos',
        'is_default',
    ];

    public function users(): belongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
