<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    use HasFactory;

    protected $table = 'perangkat_desa'; // <--- ini penting

    public $timestamps = false; // <--- karena tidak timestamp createAt dan uptanggalAt didatabase

    protected $fillable = [
        'nama',
        'nipd',
        'nik',
        'kode_kecamatan',
        'kode_desa',
        'kode_jabatan',
        'grup_jabatan',
        'mulai',
        'berakhir',
        'tempat_lahir',
        'tanggal_lahir',
        'sk_id',
        'pendidikan_id',
        'jenis_kelamin',
        'agama',
        'no_telp',
        'status_jabatan',
        'status_keaktifan',
    ];

    protected $appends = ['nama_jabatan'];

    public function getNamaJabatanAttribute()
    {
        return match ($this->kode_jabatan) {
            'PD01' => 'Kepala Desa',
            'PD02' => 'Sekretaris Desa',
            'PD03' => 'Kaur Umum dan Perencanaan',
            'PD04' => 'Kaur Keuangan',
            'PD05' => 'Kaur Perencanaan',
            'PD45' => 'Kaur Keuangan dan Perencanaan',
            'PD06' => 'Kasi Pemerintahan',
            'PD07' => 'Kasi Kesejahteraan',
            'PD08' => 'Kasi Pelayanan',
            'PD78' => 'Kasi Kesejahteraan dan Pelayanan',
            'PD09' => 'Kepala Dusun',
            'BPD01' => 'Ketua',
            'BPD02' => 'Wakil Ketua',
            'BPD03' => 'Sekretaris',
            'BPD04' => 'Anggota',
            default => '',
        };
    }


// relasi di model PerangkatDesa:
    public function absensi()
    {
        #return $this->hasMany(Absensi::class, 'perangkat_id');
        return $this->hasMany(Absensi::class, 'perangkat_id', 'id');
    }
}
