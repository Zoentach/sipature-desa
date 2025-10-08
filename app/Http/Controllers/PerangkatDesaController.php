<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\PerangkatDesa;


class PerangkatDesaController extends Controller
{
//    public function detail($id)
//    {
//        $perangkat = PerangkatDesa::findOrFail($id);
//        return view('guest.desa.perangkat', compact('perangkat'));
//    }

    public function detail($id)
    {
        // controller
        $perangkat = PerangkatDesa::with('absensi')->findOrFail($id);

        return view('guest.desa.perangkat', compact('perangkat'));
    }

    public function getDaftarPerangkat()
    {
        $jumlahGrup01 = PerangkatDesa::where('grup_jabatan', '01')
            ->where('status', 'Defenitif')
            ->count();
        $jumlahGrup02 = PerangkatDesa::where('grup_jabatan', '02')->count();
        $jumlahGrup03 = PerangkatDesa::where('grup_jabatan', '03')->count();

        return view('guest.desa.daftar_perangkat', compact('jumlahGrup01', 'jumlahGrup02', 'jumlahGrup03'));
    }

    public function getPerangkatDesa(Request $request)
    {
        $request->valitanggal([
            'kode_desa' => 'required|string|max:10',
        ]);

        $kodeDesa = $request->kode_desa;

        $perangkat = PerangkatDesa::where('kode_desa', $kodeDesa)
            ->whereIn('grup_jabatan', ['01', '02'])
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $perangkat,
        ]);
    }


    public function create()
    {
        return view('perangkat_desa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->valitanggal([
            'nama' => 'required|string|max:100',
            'nipd' => 'required|string|max:50',
            'kode_kecamatan' => 'required|string',
            'kode_desa' => 'required|string',
            'mulai' => 'required|tanggal',
            'selesai' => 'nullable|tanggal|after_or_equal:mulai',
            'nik' => 'required|digits:16',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|tanggal',
            'sk_id' => 'required|string|max:100',
            'pendidikan_id' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'status' => 'required|string',
        ]);

        PerangkatDesa::create($validated);

        return redirect()->route('perangkat_desa.create')->with('success', 'Data berhasil disimpan!');
    }
}
