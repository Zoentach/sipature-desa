<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHasilEvaluasi extends Model
{
    use HasFactory;

    protected $table = 'detail_hasil_evaluasi';

    // Semua kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'hasil_evaluasi_id',
        'instrumen_id',
        'nilai_opsi',
        'catatan',
        'foto_bukti_url'
    ];

    public function hasilEvaluasi()
    {
        return $this->belongsTo(HasilEvaluasi::class, 'hasil_evaluasi_id');
    }

    public function instrumenEvaluasi()
    {
        // Parameter kedua adalah nama foreign key di tabel detail_hasil_evaluasi
        return $this->belongsTo(InstrumenEvaluasi::class, 'instrumen_id');
    }

    public function instrumen()
    {
        // Relasi ke tabel instrumen_evaluasi
        return $this->belongsTo(InstrumenEvaluasi::class, 'instrumen_id');
    }

}
