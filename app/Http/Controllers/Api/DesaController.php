<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        // Sangat ringan, tanpa join ke perangkat desa atau indeks desa
        $desa = Desa::orderBy('nama', 'asc')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'kode_desa' => $item->kode_desa,
                'kode_kecamatan' => $item->kode_kecamatan,
                'nama_kecamatan' => $this->getNamaKecamatan($item->kode_kecamatan)
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $desa
        ], 200);
    }

    private function getNamaKecamatan($kode)
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
