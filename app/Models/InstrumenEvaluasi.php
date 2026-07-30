<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumenEvaluasi extends Model
{
    use HasFactory;

    protected $table = 'instrumen_evaluasi';
    protected $fillable = ['kelompok_id', 'uraian_tugas', 'tipe_jawaban', 'urutan', 'is_active'];

    // Relasi ke atas (Kelompok / Judul Besar)
    public function kelompokInstrumen()
    {
        return $this->belongsTo(KelompokInstrumen::class, 'kelompok_id');
    }
}
