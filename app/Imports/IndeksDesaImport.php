<?php

namespace App\Imports;

use App\Models\IndeksDesa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IndeksDesaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Pastikan nama key array ($row['...']) sesuai dengan nama kolom (header) di file Excel Anda.
        // Maatwebsite otomatis mengubah header "Kode Desa" menjadi "kode_desa" (huruf kecil dan spasi jadi underscore).
        return new IndeksDesa([
            'kode_desa' => $row['kode_desa'],
            'kode_kecamatan' => $row['kode_kecamatan'],
            'tahun' => $row['tahun'],
            'skor_iks' => $row['skor_iks'],
            'skor_ike' => $row['skor_ike'],
            'skor_ikl' => $row['skor_ikl'],
            'skor_idm' => $row['skor_idm'],
            'status_desa' => $row['status_desa'],
        ]);
    }
}
