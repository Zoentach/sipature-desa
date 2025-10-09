<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Tampilkan halaman index absensi
     */
    public function index()
    {
        return view('admin.absensi.index');
    }

    /**
     * Simpan data absensi ke database
     */
    public function store(Request $request)
    {
        $user = $request->user(); // user yang login (misalnya desa)

        $validated = $request->validate([
            'perangkat_id' => 'required|exists:perangkat_desa,id',
            'kode_desa' => 'required|string',
            'kode_kecamatan' => 'required|string',
            'tanggal' => 'required|date',
            'absensi_pagi' => 'nullable|date_format:H:i:s',
            'absensi_sore' => 'nullable|date_format:H:i:s',
            'keterlambatan' => 'nullable|integer',
            'pulang_cepat' => 'nullable|integer',
            'gambar_pagi' => 'nullable|file|image|max:2048',
            'gambar_sore' => 'nullable|file|image|max:2048',
            'keterangan' => 'nullable|string',
            'lampiran' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Ambil data perangkat
        $perangkat = PerangkatDesa::find($validated['perangkat_id']);

        // Pastikan perangkat ini milik desa yang login
        if ($perangkat->kode_desa !== $user->kode_desa) {
            return response()->json([
                'message' => 'Perangkat ini bukan milik desa Anda.'
            ], 403);
        }

        // Simpan file gambar jika ada
        if ($request->hasFile('gambar_pagi')) {
            $validated['gambar_pagi'] = $request->file('gambar_pagi')->store('foto_absensi', 'public');
        }

        if ($request->hasFile('gambar_sore')) {
            $validated['gambar_sore'] = $request->file('gambar_sore')->store('foto_absensi', 'public');
        }

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')->store('lampiran_absensi', 'public');
        }

        // ✅ Gunakan updateOrCreate (bukan uptanggalOrCreate)
        $absensi = Absensi::updateOrCreate(
            [
                'perangkat_id' => $validated['perangkat_id'],
                'tanggal' => $validated['tanggal'],
                'kode_desa' => $validated['kode_desa'],
                'kode_kecamatan' => $validated['kode_kecamatan'],
            ],
            [
                'absensi_pagi' => $validated['absensi_pagi'] ?? null,
                'absensi_sore' => $validated['absensi_sore'] ?? null,
                'keterlambatan' => $validated['keterlambatan'] ?? null,
                'pulang_cepat' => $validated['pulang_cepat'] ?? null,
                'gambar_pagi' => $validated['gambar_pagi'] ?? null,
                'gambar_sore' => $validated['gambar_sore'] ?? null,
                'keterangan' => $validated['keterangan'] ?? null,
                'lampiran' => $validated['lampiran'] ?? null,
            ]
        );

        return response()->json([
            'message' => 'Data absensi berhasil disimpan atau diperbarui.',
            'data' => $absensi
        ], 200);
    }
}
