<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerangkatDesa;
use App\Models\VerifikasiAbsensi;

// Sesuaikan jika Anda tetap menggunakan logika verifikasi

class PerangkatDesaApiController extends Controller
{
    /**
     * Mengambil daftar perangkat desa berdasarkan kode_desa
     * Endpoint: GET /api/perangkat-desa
     */
    public function index(Request $request)
    {
        // 1. Ambil kode_desa dari parameter URL (?kode_desa=12345)
        $kodeDesa = $request->query('kode_desa');

        // 2. Fallback: Jika Android tidak mengirim parameter kode_desa,
        // kita gunakan logika lama Anda (ambil dari VerifikasiAbsensi user yang login)
        if (!$kodeDesa) {
            $user = $request->user();
            $verifikasi = VerifikasiAbsensi::where('user_id', $user->id)
                ->latest()
                ->first();

            if (!$verifikasi) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kode desa tidak diberikan dan data verifikasi tidak ditemukan.'
                ], 404);
            }

            $kodeDesa = $verifikasi->kode_desa;
        }

        // 3. Tarik data dari database
        // Mengurutkan berdasarkan kode_jabatan agar Kades (PD01) tampil paling atas
        $perangkat = PerangkatDesa::where('kode_desa', $kodeDesa)
            // ->whereIn('grup_jabatan', ['01', '02']) // Aktifkan jika masih ingin membatasi grup
            ->orderBy('kode_jabatan', 'asc')
            ->get();

        // 4. MAPPING DATA: Format JSON agar 100% cocok dengan Kotlin Data Class "VillageOfficial"
        $formattedData = $perangkat->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->nama,
                'positionName' => $p->nama_jabatan, // <-- Menggunakan Accessor dari Model Anda!
                'nipd' => $p->nipd ?? '-',
                'gender' => $p->jenis_kelamin ?? 'L',
                'phoneNumber' => $p->no_telp ?? '-',
                'activityStatus' => $p->status_keaktifan ?? 'Nonaktif',
            ];
        });

        // 5. Kirim respon JSON
        return response()->json([
            'status' => 'success',
            'data' => $formattedData
        ], 200);
    }

    /**
     * (Opsional) Mengambil detail 1 perangkat desa spesifik
     * Endpoint: GET /api/perangkat-desa/{id}
     */
    public function show($id)
    {
        $perangkat = PerangkatDesa::with('absensi')->find($id);

        if (!$perangkat) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data perangkat tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'profil' => $perangkat,
                'absensi' => $perangkat->absensi // Akan otomatis ditarik berkat relasi
            ]
        ], 200);
    }
}
