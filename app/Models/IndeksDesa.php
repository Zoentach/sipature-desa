<?php

namespace App\Models;

use App\Enums\StatusDesa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndeksDesa extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (opsional jika mengikuti konvensi jamak bahasa Inggris,
     * tapi wajib ditulis karena nama tabel kita menggunakan bahasa Indonesia).
     */
    protected $table = 'indeks_desa';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'kode_desa',
        'kode_kecamatan',
        'tahun',
        'skor_iks',
        'skor_ike',
        'skor_ikl',
        'skor_idm',
        'status_desa',
    ];

    /**
     * Mendefinisikan tipe data casting menggunakan metode standar Laravel 11/12+.
     */
    protected function casts(): array
    {
        return [
            'tahun' => 'integer',
            'skor_iks' => 'decimal:4',
            'skor_ike' => 'decimal:4',
            'skor_ikl' => 'decimal:4',
            'skor_idm' => 'decimal:4',
            'status_desa' => StatusDesa::class, // Menggunakan PHP Enum
        ];
    }
}
