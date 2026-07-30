<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilEvaluasi extends Model
{
    protected $table = 'hasil_evaluasi';

    protected $fillable = [
        'desa_id',
        'perjalanan_dinas_id',
        'user_pelapor_id',
        'tanggal_evaluasi',
        'status'
    ];

    // Relasi ke SPT / Perjalanan Dinas
    public function perjalananDinas()
    {
        return $this->belongsTo(PerjalananDinas::class, 'perjalanan_dinas_id');
    }

    // Relasi ke Desa
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function userPelapor()
    {
        return $this->belongsTo(User::class, 'user_pelapor_id');
    }

    public function detailHasilEvaluasi()
    {
        return $this->hasMany(DetailHasilEvaluasi::class, 'hasil_evaluasi_id');
    }

}
