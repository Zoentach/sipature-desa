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
        'foto_kantor'
    ];

    protected $appends = ['foto_kantor_url'];

    public function getFotoKantorUrlAttribute()
    {
        if ($this->foto_kantor) {
            return asset('storage/' . $this->foto_kantor);
        }

        // Jika desa belum punya foto, berikan gambar default (opsional)
        return null;
    }

    /**
     * Relasi untuk menarik HANYA Kepala Desa (kode_jabatan = 'PD01')
     */
    public function kepalaDesa()
    {
        return $this->hasOne(PerangkatDesa::class, 'kode_desa', 'kode_desa')
            ->where('kode_jabatan', 'PD01');
        // Opsional: jika ingin memastikan yang masih aktif
        // ->where('status_keaktifan', 'Aktif');
    }

    /**
     * Relasi untuk menarik Indeks Desa tahun terbaru
     */
    public function indeksDesa()
    {
        return $this->hasOne(IndeksDesa::class, 'kode_desa', 'kode_desa')
            ->orderBy('tahun', 'desc'); // Selalu ambil tahun paling atas/terbaru
    }

    public function perangkatDesa()
    {
        return $this->hasMany(PerangkatDesa::class, 'kode_desa', 'kode_desa');
    }

    public function gambarDesa()
    {
        return $this->hasMany(GambarDesa::class, 'kode_desa', 'kode_desa');
    }

// Menarik riwayat evaluasi desa ini
    public function riwayatEvaluasi()
    {
        return $this->hasMany(HasilEvaluasi::class, 'desa_id');
    }

}
