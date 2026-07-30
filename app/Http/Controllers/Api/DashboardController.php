<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HasilEvaluasi;
use Illuminate\Http\Request;
use App\Models\PerjalananDinas;
use App\Models\DetailHasilEvaluasi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil User yang sedang login beserta data pegawainya (Eager Loading)
        $user = $request->user()->load('pegawai');
        $pegawai = $user->pegawai;

        // 2. Siapkan Data Profil
        $profil = [
            'nama' => $user->name,
            'jabatan' => $pegawai ? $pegawai->jabatan : 'Belum ditugaskan',
        ];

        // 3. Cari Tugas Mendatang (SPT)
        // Logika: Cari Perjalanan Dinas yang ada nama pegawai ini di timnya, dan statusnya disetujui (belum selesai)
        $tugasMendatang = [];
        if ($pegawai) {
            $today = Carbon::today()->toDateString(); // Tanggal hari ini (misal: 2026-07-30)

            $tugasMendatang = PerjalananDinas::whereHas('pegawais', function ($query) use ($pegawai) {
                $query->where('pegawai_id', $pegawai->id);
            })
                // ->where('status', 'disetujui')

                // LOGIKA BARU:
                // Pastikan hari ini masih di dalam rentang [Tanggal Berangkat s.d. Tanggal Selesai (Berangkat + Lama Hari)]
                // Atau tanggal berangkatnya masih di masa depan.
                ->where(function ($query) use ($today) {
                    $query->whereDate('tanggal_berangkat', '>=', $today) // Kasus 1: Belum mulai (Masa depan)
                    ->orWhereRaw("DATE_ADD(tanggal_berangkat, INTERVAL (lama_hari - 1) DAY) >= ?", [$today]); // Kasus 2: Sedang berjalan (Walau sudah lewat tanggal berangkatnya, tapi belum habis masa tugasnya)
                })
                ->orderBy('tanggal_berangkat', 'asc')
                ->get()
                ->map(function ($spt) {
                    return [
                        'id_perjalanan' => $spt->id,
                        'nomor_spt' => $spt->nomor_spt,
                        'perihal' => $spt->maksud_tujuan,
                        'tanggal' => $spt->tanggal_berangkat,
                        'lama_hari' => $spt->lama_hari,
                    ];
                });
        }

        // 4. Hitung Statistik Keseluruhan (Donut Chart)
        // Ambil HANYA hasil evaluasi TERAKHIR untuk setiap desa
        // (Bisa dikelompokkan berdasarkan desa_id, lalu diurutkan dari yang paling baru)
        $evaluasiTerakhir = HasilEvaluasi::with('detailHasilEvaluasi')
            ->orderBy('tanggal_evaluasi', 'desc')
            ->get()
            ->unique('desa_id'); // Memastikan 1 desa hanya diambil 1 data (yang paling akhir/baru)

        //Total Evaluasi adalah jumlah desa unik yang sudah dievaluasi
        $totalEvaluasi = $evaluasiTerakhir->count();

        //Kumpulkan semua baris detail jawaban HANYA dari laporan-laporan terakhir tersebut
        $semuaDetailTerakhir = $evaluasiTerakhir->flatMap(function ($laporan) {
            return $laporan->detailHasilEvaluasi;
        });

        //Hitung statistik berdasarkan jawaban dari laporan terakhir
        $totalSemuaPertanyaan = $semuaDetailTerakhir->count();
        $baikAda = $semuaDetailTerakhir->whereIn('nilai_opsi', ['Baik', 'Ada'])->count();
        $kurangTidakAda = $semuaDetailTerakhir->whereIn('nilai_opsi', ['Kurang', 'Tidak Ada'])->count();
        $rusakTk = $semuaDetailTerakhir->whereIn('nilai_opsi', ['Rusak', 'Nihil'])->count();

        // 5. Hitung Capaian Per Bidang (Bar Chart)
        // Kita menggunakan Query Builder (DB facade) agar proses hitung-hitungannya sangat cepat di level database
        // 1. Subquery untuk mencari ID hasil evaluasi terakhir per desa

        $persenBaik = 0;
        $persenKurang = 0;
        $persenRusak = 0;

        if ($totalSemuaPertanyaan > 0) {
            $persenBaik = round(($baikAda / $totalSemuaPertanyaan), 2);
            $persenKurang = round(($kurangTidakAda / $totalSemuaPertanyaan), 2);

            // MENGHINDARI BUG DECIMAL (Mencegah total jadi 99.9% atau 100.1%)
            // Alih-alih menghitung ulang, kita kurangi 100 dengan total dua yang lain
            $persenRusak = 1 - ($persenBaik + $persenKurang);
        }

        $subLatestEvaluasi = DB::table('hasil_evaluasi')
            ->select(DB::raw('MAX(id)'))
            ->groupBy('desa_id');

        // 2. Hitung Capaian Per Bidang HANYA dari evaluasi terakhir tiap desa
        $capaianBidang = DB::table('detail_hasil_evaluasi as dhe')
            // Filter hanya baris detail yang berasal dari laporan terakhir masing-masing desa
            ->whereIn('dhe.hasil_evaluasi_id', $subLatestEvaluasi)
            ->join('instrumen_evaluasi as ie', 'dhe.instrumen_id', '=', 'ie.id')
            ->join('kelompok_instrumen as ki', 'ie.kelompok_id', '=', 'ki.id')
            ->join('unit_kerja as uk', 'ki.unit_kerja_id', '=', 'uk.id')
            ->select(
                'uk.nama_unit as nama_bidang',
                DB::raw('COUNT(dhe.id) as total_pertanyaan'),
                DB::raw("SUM(CASE WHEN dhe.nilai_opsi IN ('Baik', 'Ada') THEN 1 ELSE 0 END) as total_baik")
            )
            ->groupBy('uk.id', 'uk.nama_unit')
            ->get()
            ->map(function ($item) {
                // Mencegah pembagian dengan nol
                $progress = $item->total_pertanyaan > 0 ? ($item->total_baik / $item->total_pertanyaan) : 0;
                return [
                    'nama_bidang' => $item->nama_bidang,
                    'progress' => round($progress, 2) // Dibulatkan 2 desimal (misal: 0.85)
                ];
            });

        // Kembalikan respons dalam bentuk JSON (Nampan Makanan)
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $profil,
                'tugas_mendatang' => $tugasMendatang,
                'statistik' => [
                    'total_evaluasi' => $totalEvaluasi,
                    'donut_chart' => [
                        'persen_baik' => $persenBaik,   // Menggunakan variabel persen yang sudah akurat
                        'persen_kurang' => $persenKurang, // Menggunakan variabel persen yang sudah akurat
                        'persen_rusak' => $persenRusak,  // Menggunakan sisa pengurang 100%
                    ],
                    'bar_chart_bidang' => $capaianBidang
                ]
            ]
        ], 200);
    }
}
