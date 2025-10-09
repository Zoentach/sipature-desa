<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;


class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'kode_desa',
        'kode_kecamatan',
        'tahun_berdiri',
    ];

    public function kepalaDesa()
    {
        return $this->hasOne(PerangkatDesa::class, 'kode_desa', 'kode_desa')
            ->where('jabatan', 'Kepala Desa');
    }

    public function perangkatDesa()
    {
        return $this->hasMany(PerangkatDesa::class, 'kode_desa', 'kode_desa');
    }

    public function gambarDesa()
    {
        return $this->hasMany(GambarDesa::class, 'kode_desa', 'kode_desa');
    }

}
