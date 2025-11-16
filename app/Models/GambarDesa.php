<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarDesa extends Model
{
    protected $table = 'gambar_desa';

    public $timestamps = false;

    protected $fillable = [
        'kode_desa', 'nama_file', 'keterangan',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'kode_desa', 'kode_desa');
    }
}
