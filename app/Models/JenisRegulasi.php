<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisRegulasi extends Model
{
    protected $table = 'jenis_regulasi';

    protected $fillable = [
        'nama_regulasi',
        'keterangan'
    ];

    public function regulasi()
    {
        return $this->hasMany(Regulasi::class);
    }
}
