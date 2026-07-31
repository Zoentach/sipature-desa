<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerjalananDinas;

class RiwayatTugasController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $pegawai = $user->pegawai;

        if (!$pegawai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun ini tidak memiliki data pegawai yang valid.'
            ], 404);
        }

// 1. Tangkap parameter (gunakan input() agar bisa membaca dari query string maupun body request)
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // 2. Mulai menyusun Query
        $query = PerjalananDinas::whereHas('pegawais', function ($q) use ($pegawai) {
            $q->where('pegawai.id', $pegawai->id);
        });

        // 3. Logika Filter Tanggal menggunakan whereDate (Aman untuk tipe data Date maupun DateTime)
        if ($startDate && $endDate) {
            $query->whereDate('tanggal_berangkat', '>=', $startDate)
                ->whereDate('tanggal_berangkat', '<=', $endDate);
        } elseif ($startDate) {
            $query->whereDate('tanggal_berangkat', '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate('tanggal_berangkat', '<=', $endDate);
        }

        // 4. Eksekusi query dengan urutan terbaru
        $riwayatTugas = $query->orderBy('tanggal_berangkat', 'desc')->get();

// 5. Mapping Data
        $data = $riwayatTugas->map(function ($spt) {
            return [
                'id_perjalanan' => $spt->id,
                'nomor_spt' => $spt->nomor_spt,
                'perihal' => $spt->maksud_tujuan,
                'tanggal' => $spt->tanggal_berangkat,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();
        $pegawai = $user->pegawai;

        if (!$pegawai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun tidak valid.'
            ], 404);
        }

        // 1. Tarik Data SPT menggunakan Eager Loading (with)
        // Kita tarik sekaligus: tim pegawainya, dan seluruh laporannya (beserta nama desa & pelapor)
        $spt = PerjalananDinas::with([
            'pegawais',
            'hasilEvaluasi.desa',
            'hasilEvaluasi.userPelapor'
        ])->find($id);

        if (!$spt) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tugas tidak ditemukan.'
            ], 404);
        }

        // 2. Keamanan: Pastikan user yang merequest benar-benar ada di dalam tim SPT ini
        $isAnggotaTim = $spt->pegawais->contains('id', $pegawai->id);
        if (!$isAnggotaTim) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses ke laporan tugas ini.'
            ], 403);
        }

        // 3. Mapping Data Tim (Hanya mengambil array string berisi nama-nama)
        $timBertugas = $spt->pegawais->pluck('nama')->toArray();

        // 4. Mapping Data Laporan Desa (Anak/Detail)
        $villageReports = $spt->hasilEvaluasi->map(function ($laporan) {
            return [
                'idHasilEvaluasi' => $laporan->id,
                'namaDesa' => $laporan->desa ? $laporan->desa->nama : 'Desa Tidak Diketahui',
                'tanggalEvaluasi' => $laporan->tanggal_evaluasi,
                'namaPelapor' => $laporan->userPelapor ? $laporan->userPelapor->name : 'Sistem'
            ];
        });

        // 5. Susun Nampan JSON Akhir
        return response()->json([
            'status' => 'success',
            'data' => [
                'taskInfo' => [
                    'nomorSpt' => $spt->nomor_spt,
                    'perihal' => $spt->maksud_tujuan,
                    'tanggal' => $spt->tanggal_berangkat,
                    'lamaHari' => $spt->lama_hari,
                    'timBertugas' => $timBertugas
                ],
                'villageReports' => $villageReports
            ]
        ], 200);
    }
}
