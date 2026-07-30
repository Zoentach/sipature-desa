<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    /**
     * Kolom yang boleh diisi
     */
    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'unit_kerja_id',
        'golongan',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'unit_kerja_id' => 'integer',
    ];

    /**
     * Relasi:
     * Pegawai belongsTo Unit Kerja
     */
    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    public function perjalananDinas(): BelongsToMany
    {
        return $this->belongsToMany(
            PerjalananDinas::class,
            'perjalanan_dinas_pegawai'
        );
    }

    public function user()
    {
        // Pegawai ini milik (berelasi dengan) satu User
        return $this->belongsTo(User::class, 'user_id');
    }

// Mengetahui pegawai ini sudah melakukan evaluasi ke desa mana saja
    public function hasilEvaluasi()
    {
        return $this->hasMany(HasilEvaluasi::class, 'pegawai_id');
    }
    
}
