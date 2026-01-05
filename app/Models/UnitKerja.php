<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerja';

    /**
     * Kolom yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'nama_unit',
    ];

    /**
     * Relasi:
     * Satu Unit Kerja memiliki banyak Pegawai
     */
    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'unit_kerja_id');
    }
}
