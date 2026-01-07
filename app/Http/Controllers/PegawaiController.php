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
        $targetBulanan = 20; // 20 kali = 100%

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

            // 🔥 perjalanan BULAN INI
            'perjalananDinas as bulan_ini' => function ($q) {
                $q->whereMonth('tanggal_berangkat', now()->month)
                    ->whereYear('tanggal_berangkat', now()->year);
            },
        ])
            ->orderByDesc('total_perjalanan')
            ->get();


        // 🔥 hitung persentase bulanan
        $pegawais->each(function ($pegawai) use ($targetBulanan) {
            $pegawai->persenan = min(
                round(($pegawai->bulan_ini / $targetBulanan) * 100, 2),
                100
            );
        });

        return view('guest.umum.monitoringspt', compact('pegawais'));

    }

}
