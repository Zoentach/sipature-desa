<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PerangkatDesa;
use App\Models\Absensi;
use App\Models\VerifikasiAbsensi;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{

    public function index()
    {
        return view('admin.umum.pegawai.index');
    }

    public function monitoring()
    {
        $pegawais = Pegawai::withCount([
            // total semua perjalanan
            'perjalananDinas as total_perjalanan',

            // dalam daerah
            'perjalananDinas as dalam_daerah' => function ($q) {
                $q->where('jenis_perjalanan_id', 1);
            },

            // luar daerah
            'perjalananDinas as luar_daerah' => function ($q) {
                $q->where('jenis_perjalanan_id', 2);
            },
        ])
            ->orderByDesc('total_perjalanan')
            ->get();

        return view('guest.umum.monitoringspt', compact('pegawais'));

    }

}
