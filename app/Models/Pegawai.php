<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
