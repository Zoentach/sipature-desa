<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Absensi;
use App\Models\VerifikasiAbsensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    private const absensiDistance = 1000000;

    public function index()
    {
        return view('admin.absensi.index');
    }

    public function izin()
    {
        return view('admin.absensi.izin');
    }

    public function store(Request $request)
    {
        $user = $request->user(); // user login

        $validated = $request->validate([
            'perangkat_id' => 'required|exists:perangkat_desa,id',
            'tanggal' => 'required|date',
            //'absensi_pagi' => 'nullable|date_format:H:i:s',
            //'absensi_sore' => 'nullable|date_format:H:i:s',
            'keterlambatan' => 'nullable|integer',
            'pulang_cepat' => 'nullable|integer',
            'gambar_pagi' => 'nullable|file|image|max:2048',
            'gambar_sore' => 'nullable|file|image|max:2048',
            'keterangan' => 'nullable|string',
            'lampiran' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Ambil perangkat desa
        $perangkat = PerangkatDesa::findOrFail($validated['perangkat_id']);

        //  Ambil data verifikasi user (bisa latest)
        $verifikasiAbsensi = VerifikasiAbsensi::where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$verifikasiAbsensi) {
            return response()->json([
                'message' => 'Data verifikasi tidak ditemukan. Silakan lakukan verifikasi terlebih dahulu.'
            ], 403);
        }

        //Pastikan kode desa cocok
        if ($perangkat->kode_desa !== $verifikasiAbsensi->kode_desa) {
            return response()->json([
                'message' => 'Kode desa tidak sesuai.'
            ], 403);
        }

        $macAddress = $request->mac_address ?? null;

        if (!$macAddress) {
            return response()->json([
                'message' => 'MAC Address tidak ditemukan di permintaan.'
            ], 400);
        }

        if ($verifikasiAbsensi->mac_address !== $macAddress) {
            return response()->json([
                'message' => 'Perangkat ini tidak terverifikasi. MAC Address tidak cocok.'
            ], 403);
        }

        //(Opsional) Validasi lokasi dalam radius 10 meter
        if ($verifikasiAbsensi->latitude &&
            $verifikasiAbsensi->longitude &&
            $request->latitude &&
            $request->longitude) {

            $distance = $this->calculateDistance(
                $verifikasiAbsensi->latitude,
                $verifikasiAbsensi->longitude,
                $request->latitude ?? 0,
                $request->longitude ?? 0
            );

            if ($distance > self::absensiDistance) {
                return response()->json([
                    'message' => 'Anda berada di luar radius 10 meter dari lokasi verifikasi.'
                ], 403);
            }
        }

        // Upload file jika ada
        if ($request->hasFile('gambar_pagi')) {
            $validated['gambar_pagi'] = $request->file('gambar_pagi')->store('foto_absensi', 'public');
        }

        if ($request->hasFile('gambar_sore')) {
            $validated['gambar_sore'] = $request->file('gambar_sore')->store('foto_absensi', 'public');
        }

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')->store('lampiran_absensi', 'public');
        }

        // Simpan absensi (gunakan updateOrCreate agar tidak duplikat)
        $absensi = Absensi::updateOrCreate(
            [
                'perangkat_id' => $validated['perangkat_id'],
                'tanggal' => $validated['tanggal'],
                'kode_desa' => $verifikasiAbsensi->kode_desa,
                'kode_kecamatan' => $verifikasiAbsensi->kode_kecamatan,
            ],
            [
                'absensi_pagi' => $validated['absensi_pagi'] ?? null,
                'absensi_sore' => $validated['absensi_sore'] ?? null,
                'keterlambatan' => $validated['keterlambatan'] ?? null,
                'pulang_cepat' => $validated['pulang_cepat'] ?? null,
                'gambar_pagi' => $validated['gambar_pagi'] ?? null,
                'gambar_sore' => $validated['gambar_sore'] ?? null,
                'keterangan' => 'Hadir',
                'lampiran' => $validated['lampiran'] ?? null,
            ]
        );


        return response()->json([
            'message' => 'Data absensi berhasil disimpan atau diperbarui.',
            'data' => $absensi
        ], 200);
    }

    public function storeLampiran(Request $request)
    {
        $user = $request->user();

        // Validasi input
        $validated = $request->validate([
            'perangkat_id' => 'required|exists:perangkat_desa,id',
            'tanggal' => 'required|date',
            'keterangan' => 'required|in:Izin,Sakit,Cuti,Tugas Luar',
            'lampiran' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Ambil data perangkat
        $perangkat = PerangkatDesa::findOrFail($validated['perangkat_id']);

        // Verifikasi user dan kode desa
        $verifikasiAbsensi = VerifikasiAbsensi::where('user_id', $user->id)->latest()->first();
        if (!$verifikasiAbsensi) {
            return response()->json(['message' => 'Data verifikasi tidak ditemukan.'], 403);
        }

        if ($perangkat->kode_desa !== $verifikasiAbsensi->kode_desa) {
            return response()->json(['message' => 'Kode desa tidak sesuai.'], 403);
        }

//        $macAddress = $request->mac_address ?? null;
//
//        if (!$macAddress) {
//            return response()->json([
//                'message' => 'MAC Address tidak ditemukan di permintaan.'
//            ], 400);
//        }
//
//        if ($verifikasiAbsensi->mac_address !== $macAddress) {
//            return response()->json([
//                'message' => 'Perangkat ini tidak terverifikasi. MAC Address tidak cocok.'
//            ], 403);
//        }

        //(Opsional) Validasi lokasi dalam radius 10 meter
        if ($verifikasiAbsensi->latitude &&
            $verifikasiAbsensi->longitude &&
            $request->latitude &&
            $request->longitude) {

            $distance = $this->calculateDistance(
                $verifikasiAbsensi->latitude,
                $verifikasiAbsensi->longitude,
                $request->latitude ?? 0,
                $request->longitude ?? 0
            );

            if ($distance > self::absensiDistance) {
                return response()->json([
                    'message' => 'Anda berada di luar radius 10 meter dari lokasi verifikasi.'
                ], 403);
            }
        }

        // Simpan lampiran ke storage
        $lampiranPath = $request->file('lampiran')->store('lampiran_absensi', 'public');

        // Create or Replace berdasarkan perangkat_id + tanggal
        $absensi = Absensi::updateOrCreate(
            [
                'perangkat_id' => $validated['perangkat_id'],
                'tanggal' => $validated['tanggal'],
            ],
            [
                'kode_desa' => $verifikasiAbsensi->kode_desa,
                'kode_kecamatan' => $verifikasiAbsensi->kode_kecamatan,
                'keterangan' => $validated['keterangan'], // enum: Izin, Sakit, Cuti, Tugas Luar
                'lampiran' => $lampiranPath,
                'keterlambatan' => 0,
                'pulang_cepat' => 0,
                'status_kehadiran' => 'Pending', // menunggu persetujuan atasan
                'sync_status' => 0,
                'absensi_pagi' => null,
                'absensi_sore' => null,
            ]
        );

        return response()->json([
            'message' => 'Data izin berhasil disimpan atau diperbarui.',
            'data' => $absensi
        ], 200);
    }


    /**
     * Hitung jarak antara dua titik koordinat (meter)
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meter
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $earthRadius * $angle;
    }
}
