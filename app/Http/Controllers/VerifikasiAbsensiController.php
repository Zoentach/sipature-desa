<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerifikasiAbsensi;

class VerifikasiAbsensiController extends Controller
{
    /**
     * Simpan data verifikasi absensi
     */
    public function store(Request $request)
    {
        $user = $request->user(); // user login dari Sanctum

        // Validasi input
        $validated = $request->validate([
            'kode_kecamatan' => 'required|string|max:20',
            'kode_desa' => 'required|string|max:20',
            'mac_address' => 'nullable|string|max:50',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        // Cek apakah sudah ada verifikasi untuk user ini
        $existing = VerifikasiAbsensi::where('user_id', $user->id)->first();

        if ($existing) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data verifikasi sudah ada untuk user ini.',
                'data' => $existing
            ], 409); // 409 Conflict
        }

        // Buat baru jika belum ada
        $verifikasi = VerifikasiAbsensi::create([
            'user_id' => $user->id,
            'kode_kecamatan' => $validated['kode_kecamatan'],
            'kode_desa' => $validated['kode_desa'],
            'mac_address' => $validated['mac_address'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data verifikasi berhasil disimpan.',
            'data' => $verifikasi
        ], 201);
    }


    public function getVerifikasiAbsensi(Request $request)
    {
        $user = $request->user(); // user yang sedang login

        // Ambil data verifikasi milik user login
        $verifikasi = \App\Models\VerifikasiAbsensi::where('user_id', $user->id)->first();

        if (!$verifikasi) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'Data verifikasi belum tersedia untuk user ini.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $verifikasi
        ], 200);
    }

}
