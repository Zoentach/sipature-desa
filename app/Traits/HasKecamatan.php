<?php

namespace App\Traits;

trait HasKecamatan
{
    protected function getNamaKecamatan($kode)
    {
        $daftarKecamatan = [
            '120301' => 'ANGKOLA BARAT',
            '120302' => 'BATANG TORU',
            '120303' => 'ANGKOLA TIMUR',
            '120304' => 'SIPIROK',
            '120305' => 'SAIPAR DOLOK HOLE',
            '120306' => 'ANGKOLA SELATAN',
            '120307' => 'BATANG ANGKOLA',
            '120314' => 'ARSE',
            '120320' => 'MARANCAR',
            '120321' => 'SAYURMATINGGI',
            '120322' => 'AEK BILAH',
            '120329' => 'MUARA BATANGTORU',
            '120330' => 'ANGKOLA SANGKUNUR',
            '120332' => 'ANGKOLA MUARATAIS',
        ];

        return $daftarKecamatan[$kode] ?? 'Kecamatan Tidak Diketahui';
    }
}
