<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{

    // Jika nama tabel tidak mengikuti konvensi jamak, tentukan manual
    protected $table = 'absensi';

    // Jika kamu tidak menggunakan kolom `created_at` dan `uptanggald_at`
    // public $timestamps = false;

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'kode_desa',
        'kode_kecamatan',
        'perangkat_id',
        'tanggal',
        'absensi_pagi',
        'absensi_sore',
        'keterlambatan',
        'pulang_cepat',
        'gambar_pagi',
        'gambar_sore',
        'keterangan',
        'lampiran',
        'status_kehadiran'

    ];

    protected $appends = ['nama_perangkat', 'nama_jabatan'];

    // Cast agar field seperti tanggal bisa diproses sebagai integer
    protected $casts = [
        'tanggal' => 'date',
        //'absensi_pagi' => 'date_format:H:i:s',
        //'absensi_sore' => 'date_format:H:i:s',
        'keterlambatan' => 'integer',
        'pulang_cepat' => 'integer',
        'gambar_pagi' => 'string',
        'gambar_sore' => 'string',
    ];


    public function getNamaPerangkatAttribute(): ?string
    {
        return $this->perangkat->nama ?? null;
    }

    public function getNamaJabatanAttribute(): ?string
    {
        return $this->perangkat->nama_jabatan ?? null;
    }


    // Relasi
    public function perangkat(): BelongsTo
    {
        return $this->belongsTo(PerangkatDesa::class, 'perangkat_id', 'id');
    }

    public function getImageMorningUrlAttribute(): ?string
    {
        return $this->gambar_pagi ? asset('storage/' . $this->gambar_pagi) : null;
    }

    public function getImageAfternoonUrlAttribute(): ?string
    {
        return $this->gambar_sore ? asset('storage/' . $this->gambar_sore) : null;
    }


}
