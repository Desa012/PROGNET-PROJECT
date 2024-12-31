<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

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

    public function pesanans(): hasMany
    {
        return $this->hasMany(Alamat::class, 'id_alamat', 'id_alamat');
    }
}
