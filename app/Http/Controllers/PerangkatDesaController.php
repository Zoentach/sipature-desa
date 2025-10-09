<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class PerangkatDesaController extends Controller
{
    /**
     * Detail perangkat desa + relasi absensi
     */
    public function detail($id)
    {
        $perangkat = PerangkatDesa::with('absensi')->findOrFail($id);

        return view('guest.desa.perangkat', compact('perangkat'));
    }

    /**
     * Hitung jumlah perangkat per grup jabatan
     */
    public function getDaftarPerangkat()
    {
        $jumlahGrup01 = PerangkatDesa::where('grup_jabatan', '01')
            ->where('status_jabatan', 'Definitif') // ← perbaikan nama kolom & value
            ->count();

        $jumlahGrup02 = PerangkatDesa::where('grup_jabatan', '02')->count();
        $jumlahGrup03 = PerangkatDesa::where('grup_jabatan', '03')->count();

        return view('guest.desa.daftar_perangkat', compact('jumlahGrup01', 'jumlahGrup02', 'jumlahGrup03'));
    }

    /**
     * Ambil daftar perangkat berdasarkan kode desa (API JSON)
     */
    public function getPerangkatDesa(Request $request)
    {
        $user = $request->user();

        // Ambil data verifikasi terbaru dari user
        $verifikasi = \App\Models\VerifikasiAbsensi::where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$verifikasi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data verifikasi tidak ditemukan. Silakan lakukan verifikasi terlebih dahulu.'
            ], 403);
        }

        // Ambil perangkat berdasarkan kode desa dari verifikasi
        $perangkat = PerangkatDesa::where('kode_desa', $verifikasi->kode_desa)
            ->whereIn('grup_jabatan', ['01', '02'])
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $perangkat,
        ]);
    }

    /**
     * Form create perangkat
     */
    public function create()
    {
        return view('perangkat_desa.create');
    }

    /**
     * Simpan data perangkat ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nipd' => 'nullable|string|max:30|unique:perangkat_desa,nipd',
            'nik' => 'nullable|string|max:30|unique:perangkat_desa,nik',
            'kode_kecamatan' => 'nullable|string|max:20',
            'kode_desa' => 'nullable|string|max:20',
            'kode_jabatan' => 'nullable|string|max:10',
            'grup_jabatan' => 'nullable|string|max:50',
            'mulai' => 'nullable|date',
            'berakhir' => 'nullable|date|after_or_equal:mulai',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'sk_id' => 'nullable|integer',
            'pendidikan_id' => 'nullable|integer',
            'jenis_kelamin' => 'nullable|in:L,P', // sesuai enum schema
            'agama' => 'nullable|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu',
            'no_telp' => 'nullable|string|max:20',
            'status_jabatan' => 'nullable|in:Definitif,Pelaksana Tugas,Pelaksana Harian,Kosong',
            'status_keaktifan' => 'nullable|in:Aktif,Nonaktif,Pensiun,Berhenti',
        ]);

        PerangkatDesa::create($validated);

        return redirect()
            ->route('perangkat_desa.create')
            ->with('success', 'Data perangkat desa berhasil disimpan!');
    }
}
