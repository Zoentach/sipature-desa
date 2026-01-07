<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisRegulasi;

class JenisRegulasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_regulasi' => 'Peraturan Bupati',
                'keterangan' => 'Peraturan yang ditetapkan oleh Bupati'
            ],
            [
                'nama_regulasi' => 'Peraturan Walikota',
                'keterangan' => 'Peraturan yang ditetapkan oleh Walikota'
            ],
            [
                'nama_regulasi' => 'Peraturan Daerah',
                'keterangan' => 'Peraturan Daerah Provinsi atau Kabupaten/Kota'
            ],
            [
                'nama_regulasi' => 'Peraturan Pemerintah',
                'keterangan' => 'Peraturan yang ditetapkan oleh Pemerintah Pusat'
            ],
            [
                'nama_regulasi' => 'Peraturan Menteri Dalam Negeri',
                'keterangan' => 'Peraturan yang ditetapkan oleh Menteri Dalam Negeri'
            ],
            [
                'nama_regulasi' => 'Peraturan Menteri Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi',
                'keterangan' => 'Peraturan yang ditetapkan oleh Kementerian Desa PDTT'
            ],
            [
                'nama_regulasi' => 'Keputusan Menteri Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi',
                'keterangan' => 'Keputusan resmi Menteri Desa PDTT'
            ],
            [
                'nama_regulasi' => 'Instruksi Menteri Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi',
                'keterangan' => 'Instruksi pelaksanaan dari Menteri Desa PDTT'
            ],
            [
                'nama_regulasi' => 'Surat Edaran Menteri Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi',
                'keterangan' => 'Surat edaran sebagai pedoman teknis dari Menteri Desa PDTT'
            ],
            [
                'nama_regulasi' => 'Petunjuk Teknis',
                'keterangan' => 'Petunjuk teknis pelaksanaan kegiatan atau program'
            ],
        ];

        foreach ($data as $item) {
            JenisRegulasi::create($item);
        }
    }
}
