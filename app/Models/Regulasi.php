<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulasi extends Model
{
    protected $table = 'regulasi';

    protected $fillable = [
        'jenis_regulasi_id',
        'nomor_regulasi',
        'tahun',
        'tentang',
        'unit_kerja_id',
        'file_dokumen'
    ];

    public function jenisRegulasi()
    {
        return $this->belongsTo(JenisRegulasi::class);
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }
}
