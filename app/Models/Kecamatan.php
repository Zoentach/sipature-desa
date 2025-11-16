<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;


class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'kode_kecamatan',
        'tahun_berdiri',
    ];

    public function desas()
    {
        return $this->hasMany(Desa::class, 'kode_kecamatan', 'kode_kecamatan');
    }

}
