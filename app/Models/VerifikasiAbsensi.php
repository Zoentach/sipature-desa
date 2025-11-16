<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifikasiAbsensi extends Model
{
    protected $table = 'verifikasi_absensi';

    protected $fillable = [
        'user_id',
        'kode_kecamatan',
        'kode_desa',
        'mac_address',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
