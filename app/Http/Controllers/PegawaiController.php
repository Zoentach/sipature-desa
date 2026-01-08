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

        // PRIORITAS JABATAN (PALING ATAS)
        $jabatanPrioritas = [
            'Kepala Dinas PMD',
            'Pj.Kabid. Pemberdayaan Ekonomi Masyarakat Desa',
            'Pj.Kabid. Pemerintahan Desa',
            'Pj.Kabid. Pemberdayaan Kelembagaan Masyarakat Desa',
            'Kasubbag. Umum Dan Kepegawaian',
            'Kasubbag. Bagian Perencanaan Dan Keuangan',
        ];


// urutan golongan PNS (TERTINGGI → TERENDAH)
        $golonganPNS = [
            'IV/e', 'IV/d', 'IV/c', 'IV/b', 'IV/a',
            'III/d', 'III/c', 'III/b', 'III/a',
            'II/d', 'II/c', 'II/b', 'II/a',
        ];

// urutan golongan PPPK (di bawah PNS)
        $golonganPPPK = [
            'IX', 'VIII', 'VII', 'VI', 'V'
        ];

// SQL ORDER BY custom
        $orderByCustom = "
    CASE
        WHEN jabatan IN ('" . implode("','", $jabatanPrioritas) . "') THEN 0
        WHEN golongan IN ('" . implode("','", $golonganPNS) . "') THEN 1
        WHEN golongan IN ('" . implode("','", $golonganPPPK) . "') THEN 2
        ELSE 3
    END,
    FIELD(jabatan, '" . implode("','", $jabatanPrioritas) . "'),
    FIELD(golongan, '" . implode("','", array_merge($golonganPNS, $golonganPPPK)) . "')
";


        $pegawais = Pegawai::withCount([

            //total semua perjalanan
            'perjalananDinas as total_perjalanan',

            //dalam daerah
            'perjalananDinas as dalam_daerah' => function ($q) {
                $q->where('jenis_perjalanan_id', 1);
            },

            //luar daerah
            'perjalananDinas as luar_daerah' => function ($q) {
                $q->where('jenis_perjalanan_id', 2);
            },

            //perjalanan BULAN INI
            'perjalananDinas as bulan_ini' => function ($q) {
                $q->whereMonth('tanggal_berangkat', now()->month)
                    ->whereYear('tanggal_berangkat', now()->year);
            },
        ])
            ->orderByRaw($orderByCustom)
            ->get();


        //hitung persentase bulanan
        $pegawais->each(function ($pegawai) use ($targetBulanan) {
            $pegawai->persenan = min(
                round(($pegawai->bulan_ini / $targetBulanan) * 100, 2),
                100
            );
        });

        return view('guest.umum.monitoringspt', compact('pegawais'));

    }

}
