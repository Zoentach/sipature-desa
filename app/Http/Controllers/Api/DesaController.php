<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Traits\HasKecamatan;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    use HasKecamatan;

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
}
