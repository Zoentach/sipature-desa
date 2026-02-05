<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;

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


//        $pegawais = Pegawai::withCount([
//
//            //total semua perjalanan
//            'perjalananDinas as total_perjalanan',
//
//            //dalam daerah
//            'perjalananDinas as dalam_daerah' => function ($q) {
//                $q->where('jenis_perjalanan_id', 1);
//            },
//
//            //luar daerah
//            'perjalananDinas as luar_daerah' => function ($q) {
//                $q->where('jenis_perjalanan_id', 2);
//            },
//
//            //perjalanan BULAN INI
//            'perjalananDinas as bulan_ini' => function ($q) {
//                $q->whereMonth('tanggal_berangkat', now()->month)
//                    ->whereYear('tanggal_berangkat', now()->year);
//            },
//        ])
//            ->orderByRaw($orderByCustom)
//            ->get();


        $pegawais = Pegawai::query()
            ->select('pegawai.*')

            // TOTAL HARI
            ->selectSub(function ($q) {
                $q->from('perjalanan_dinas')
                    ->join('perjalanan_dinas_pegawai', 'perjalanan_dinas.id', '=', 'perjalanan_dinas_pegawai.perjalanan_dinas_id')
                    ->whereColumn('perjalanan_dinas_pegawai.pegawai_id', 'pegawai.id')
                    ->selectRaw('COALESCE(SUM(perjalanan_dinas.lama_hari), 0)');
            }, 'total_hari')

            // DALAM DAERAH
            ->selectSub(function ($q) {
                $q->from('perjalanan_dinas')
                    ->join('perjalanan_dinas_pegawai', 'perjalanan_dinas.id', '=', 'perjalanan_dinas_pegawai.perjalanan_dinas_id')
                    ->whereColumn('perjalanan_dinas_pegawai.pegawai_id', 'pegawai.id')
                    ->where('perjalanan_dinas.jenis_perjalanan_id', 1)
                    ->selectRaw('COALESCE(SUM(perjalanan_dinas.lama_hari), 0)');
            }, 'dalam_daerah_hari')

            // LUAR DAERAH
            ->selectSub(function ($q) {
                $q->from('perjalanan_dinas')
                    ->join('perjalanan_dinas_pegawai', 'perjalanan_dinas.id', '=', 'perjalanan_dinas_pegawai.perjalanan_dinas_id')
                    ->whereColumn('perjalanan_dinas_pegawai.pegawai_id', 'pegawai.id')
                    ->where('perjalanan_dinas.jenis_perjalanan_id', 2)
                    ->selectRaw('COALESCE(SUM(perjalanan_dinas.lama_hari), 0)');
            }, 'luar_daerah_hari')

            // BULAN INI
            ->selectSub(function ($q) {
                $q->from('perjalanan_dinas')
                    ->join(
                        'perjalanan_dinas_pegawai',
                        'perjalanan_dinas.id',
                        '=',
                        'perjalanan_dinas_pegawai.perjalanan_dinas_id'
                    )
                    ->whereColumn(
                        'perjalanan_dinas_pegawai.pegawai_id',
                        'pegawai.id'
                    )
                    ->whereMonth('perjalanan_dinas.tanggal_berangkat', now()->month)
                    ->whereYear('perjalanan_dinas.tanggal_berangkat', now()->year)
                    ->selectRaw('COALESCE(SUM(perjalanan_dinas.lama_hari), 0)');
            }, 'bulan_ini_hari')

            // ORDER CUSTOM TETAP JALAN
            ->orderByRaw($orderByCustom)
            ->get();

        // BULAN INI


        //hitung persentase bulanan
        $pegawais->each(function ($pegawai) use ($targetBulanan) {
            $pegawai->persenan = min(
                round(($pegawai->bulan_ini_hari / $targetBulanan) * 100, 2),
                100
            );
        });

        return view('guest.umum.monitoringspt', compact('pegawais'));

    }

}
