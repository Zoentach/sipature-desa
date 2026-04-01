<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Models\Desa;
use App\Models\PerangkatDesa;

class DesaController extends Controller
{
    /**
     * Tampilkan semua desa (guest)
     */
    public function getAll()
    {
        $desas = Desa::with(['kepalaDesa', 'indeksDesa']) // Ambil relasi sekaligus
        ->when(request('search'), function ($query) {
            $query->where('nama', 'like', '%' . request('search') . '%');
        })
            ->when(request('kecamatan'), function ($query) {
                $query->where('kode_kecamatan', request('kecamatan'));
            })
            ->orderBy('nama')
            ->paginate(20);

        $kecamatans = Kecamatan::all();

        return view('guest.desa.daftar_desa', compact('desas', 'kecamatans'));
    }

    /**
     * Fitur pencarian desa berdasarkan nama
     */
    public function search(Request $request)
    {
        $keyword = $request->get('query');

        // Validasi input agar tidak kosong
        if (!$keyword || strlen($keyword) < 2) {
            return response()->json([]);
        }

        // Query pencarian fleksibel (kompatibel untuk PostgreSQL & MySQL)
        $query = Desa::with('kepalaDesa')->limit(10);

        if (config('database.default') === 'pgsql') {
            $query->where('nama', 'ILIKE', "%{$keyword}%");
        } else {
            $query->where('nama', 'LIKE', "%{$keyword}%");
        }

        $results = $query->orderBy('nama')->get();

        return response()->json($results);
    }

    /**
     * Tampilkan detail desa
     * Menggunakan route model binding agar otomatis 404 jika tidak ditemukan
     */
    public function detail(Desa $desa)
    {
        // Ambil relasi yang diperlukan
        $desa->load('perangkatDesa', 'gambarDesa', 'kepalaDesa');

        return view('guest.desa.detail', compact('desa'));
    }
}
