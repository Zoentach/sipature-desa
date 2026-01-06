<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPerjalanan extends Model
{
    protected $table = 'jenis_perjalanan';

    /**
     * Kolom yang boleh di–mass assign
     */
    protected $fillable = [
        'nama',
    ];

    /**
     * Relasi:
     * 1 Jenis Perjalanan -> Banyak Perjalanan Dinas
     */
    public function perjalananDinas(): HasMany
    {
        return $this->hasMany(
            PerjalananDinas::class,
            'jenis_perjalanan_id'
        );
    }
}
