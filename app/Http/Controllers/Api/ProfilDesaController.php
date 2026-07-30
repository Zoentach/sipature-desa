<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\HasilEvaluasi;
use App\Models\DetailHasilEvaluasi;
use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    public function show($id)
    {
        // 1. Ambil Data Master Desa beserta Relasi Kepala Desa & Indeks
        $desa = Desa::with(['kepalaDesa', 'indeksDesa'])->find($id);

        if (!$desa) {
            return response()->json(['status' => 'error', 'message' => 'Desa tidak ditemukan'], 404);
        }

        // --- A. FORMAT DATA PROFIL ---
        $statusDesa = '-';
        if ($desa->indeksDesa && $desa->indeksDesa->status_desa) {
            $enumStatus = $desa->indeksDesa->status_desa;
            $statusDesa = $enumStatus->value ?? $enumStatus->name ?? (string)$enumStatus;
        }

        $profilData = [
            'id' => $desa->id,
            'nama' => $desa->nama,
            'kodeDesa' => $desa->kode_desa,
            'namaKecamatan' => $this->getNamaKecamatan($desa->kode_kecamatan),
            'tahunBerdiri' => $desa->tahun_berdiri ?? '-',
            'fotoKantorUrl' => $desa->foto_kantor_url,
            'kepalaDesa' => $desa->kepalaDesa ? $desa->kepalaDesa->nama : '-',
            'statusDesa' => ucfirst(strtolower($statusDesa))
        ];


        // 2. Ambil Laporan Evaluasi Terakhir (Jika Ada)
        // Kita cari laporan milik desa ini yang statusnya SELESAI, diurutkan paling baru
        $laporanTerakhir = HasilEvaluasi::where('desa_id', $desa->id)
            ->where('status', 'SELESAI')
            ->latest('tanggal_evaluasi')
            ->first();

        $catatanList = [];
        $riwayatList = [];

        if ($laporanTerakhir) {
            // Tarik detail jawaban dari laporan tersebut beserta relasi instrumennya
            // (Asumsi di Model DetailHasilEvaluasi ada relasi instrumenEvaluasi)
            $details = DetailHasilEvaluasi::with([
                'instrumenEvaluasi.kelompokInstrumen.unitKerja'
            ])->where('hasil_evaluasi_id', $laporanTerakhir->id)->get();

            // --- B. KUMPULKAN CATATAN TINDAK LANJUT ---
            foreach ($details as $detail) {
                if (!empty($detail->catatan)) {
                    $catatanList[] = [
                        'instrumen' => $detail->instrumenEvaluasi->uraian_tugas ?? 'Instrumen',
                        'catatan' => $detail->catatan
                    ];
                }
            }

            // --- C. KUMPULKAN RIWAYAT & GROUPING BERDASARKAN BIDANG ---
            // Kita kelompokkan jawaban berdasarkan nama unit kerja (misal: "Pemerintahan Desa")
            $groupedDetails = $details->groupBy(function ($item) {
                return $item->instrumenEvaluasi->kelompokInstrumen->unitKerja->nama_unit ?? 'Lainnya';
            });

            foreach ($groupedDetails as $namaBidang => $items) {
                $detailRiwayat = $items->map(function ($item) {
                    return [
                        'uraianTugas' => $item->instrumenEvaluasi->uraian_tugas ?? '-',
                        'nilaiOpsi' => $item->nilai_opsi
                    ];
                })->values()->toArray();

                $riwayatList[] = [
                    'namaBidang' => $namaBidang,
                    'detail' => $detailRiwayat
                ];
            }
        }

        // 3. Kembalikan semua data dalam satu paket JSON yang siap pakai untuk Jetpack Compose
        return response()->json([
            'status' => 'success',
            'data' => [
                'desa' => $profilData,
                'catatanList' => $catatanList,
                'riwayatList' => $riwayatList
            ]
        ], 200);
    }

    private function getNamaKecamatan($kode)
    {
        $daftarKecamatan = [
            '127101' => 'Sipirok',
            '127102' => 'Angkola Timur',
            '127103' => 'Arse',
            '127104' => 'Saipar Dolok Hole'
        ];
        return $daftarKecamatan[$kode] ?? 'Kecamatan Tidak Diketahui';
    }
}
