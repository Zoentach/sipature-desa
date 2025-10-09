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
            ->where('status', 'Defenitif')
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

        //Ambil data verifikasi terbaru dari user
        $verifikasi = \App\Models\VerifikasiAbsensi::where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$verifikasi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data verifikasi tidak ditemukan. Silakan lakukan verifikasi terlebih dahulu.'
            ], 403);
        }

        //Ambil perangkat berdasarkan kode desa dari verifikasi
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
            'nipd' => 'required|string|max:50',
            'kode_kecamatan' => 'required|string|max:10',
            'kode_desa' => 'required|string|max:10',
            'mulai' => 'required|date',                // ← diperbaiki dari "tanggal" ke "date"
            'selesai' => 'nullable|date|after_or_equal:mulai', // ← juga diperbaiki
            'nik' => 'required|digits:16',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'sk_id' => 'required|string|max:100',
            'pendidikan_id' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'no_telp' => 'required|string|max:15',
            'status' => 'required|in:Defenitif,Plt,Honor,Magang', // ← bisa kamu sesuaikan enum-nya
        ]);

        PerangkatDesa::create($validated);

        return redirect()
            ->route('perangkat_desa.create')
            ->with('success', 'Data perangkat desa berhasil disimpan!');
    }
}
