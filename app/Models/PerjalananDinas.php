<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjalananDinas extends Model
{
    protected $table = 'perjalanan_dinas';

    protected $fillable = [
        'jenis_perjalanan_id',
        'nomor_spt',
        'maksud_tujuan',
        'tanggal_berangkat',
        'tanggal_kembali',
        'lama_hari',
        'status'
    ];

    public function pegawais()
    {
        return $this->belongsToMany(
            Pegawai::class,
            'perjalanan_dinas_pegawai'
        )->withTimestamps();
    }

    public function jenisPerjalanan()
    {
        return $this->belongsTo(JenisPerjalanan::class);
    }

}
