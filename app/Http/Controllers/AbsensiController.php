<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{

    /**
     *ambil data
     */


    public function index()
    {
        return view('admin.absensi.index');
    }

//    public function index($userId)
//    {
//        $absensi = Attendance::where('user_id', $userId) // pastikan ada relasi 'perangkat'
//        ->orderBy('tanggal', 'desc')
//            ->get();
//
//        return view('attendance.index', compact('absensi'));
//    }


    /**
     * Simpan data absensi ke database
     */
    public function store(Request $request)
    {
        $user = $request->user(); // user yang login (desa)

        $validated = $request->valitanggal([
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

        // Cek apakah perangkat ini milik user login (berdasarkan kode_desa)
        if ($perangkat->kode_desa !== $user->kode_desa) {
            return response()->json([
                'message' => 'Perangkat ini bukan milik desa Anda.'
            ], 403);
        }

        // Simpan file gambar jika ada
        if ($request->hasFile('gambar_pagi')) {
            $pathMorning = $request->file('gambar_pagi')->store('foto_absensi', 'public');
            $validated['gambar_pagi'] = $pathMorning;
        }

        if ($request->hasFile('gambar_sore')) {
            $pathAfternoon = $request->file('gambar_sore')->store('foto_absensi', 'public');
            $validated['gambar_sore'] = $pathAfternoon;
        }


        $attendance = Absensi::uptanggalOrCreate(
            [
                'perangkat_id' => $validated['user_id'],
                'tanggal' => $validated['tanggal'],
                'kode_desa' => $validated['kode_desa'],
                'kode_kecamatan' => $validated['kode_kecamatan']
            ],
            [
                'sbsensi_pagi' => $validated['absensi_pagi'] ?? null,
                'absensi_sore' => $validated['absensi_sore'] ?? null,
                'keterlambatan' => $validated['keterlambatan'] ?? null,
                'pulang_cepat' => $validated['pulang_cepat'] ?? null,
                'gambar_pagi' => $validated['gambar_pagi'] ?? null,
                'gambar_sore' => $validated['gambar_sore'] ?? null,
            ]
        );

        return response()->json([
            'message' => 'Data absensi berhasil disimpan atau diperbarui.',
            'data' => $attendance
        ], 200);
    }

}
