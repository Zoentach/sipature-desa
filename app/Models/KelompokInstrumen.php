<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokInstrumen extends Model
{
    use HasFactory;

    protected $table = 'kelompok_instrumen';
    protected $fillable = ['unit_kerja_id', 'nama_kelompok', 'urutan'];

    // Relasi ke atas (Unit Kerja / Bidang)
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    // Relasi ke bawah (Daftar Pertanyaan Ceklis)
    public function instrumenEvaluasi()
    {
        return $this->hasMany(InstrumenEvaluasi::class, 'kelompok_id');
    }
    
}
