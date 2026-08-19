<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerifikasiAbsensi;

class VerifikasiAbsensiController extends Controller
{
    /**
     * Tampilkan halaman index dashboard (Memanggil Livewire)
     */
    public function index()
    {
        return view('admin.absensi.device');
    }

    /**
     * Tampilkan halaman form edit
     */
    public function edit($id)
    {
        $verifikasi = VerifikasiAbsensi::findOrFail($id);
        return view('admin.absensi.device_edit', compact('verifikasi'));
    }

    /**
     * Proses update data dari form edit
     */
    public function update(Request $request, $id)
    {
        $verifikasi = VerifikasiAbsensi::findOrFail($id);

        $validated = $request->validate([
            'mac_address' => 'nullable|string|max:50',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $verifikasi->update($validated);

        return redirect()->route('absensi.device')->with('message', 'Data device absensi berhasil diperbarui.');
    }

    /**
     * Simpan data verifikasi absensi (API / Mobile)
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'kode_kecamatan' => 'required|string|max:20',
            'kode_desa' => 'required|string|max:20',
            'mac_address' => 'nullable|string|max:50',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $existing = VerifikasiAbsensi::where('user_id', $user->id)->first();

        if ($existing) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data verifikasi sudah ada untuk user ini.',
                'data' => $existing
            ], 409);
        }

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

    /**
     * Ambil data (API / Mobile)
     */
    public function getVerifikasiAbsensi(Request $request)
    {
        $user = $request->user();

        $verifikasi = VerifikasiAbsensi::where('user_id', $user->id)->first();

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
