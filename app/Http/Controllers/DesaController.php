<?php

namespace App\Http\Controllers;

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
        // Jika datanya banyak, gunakan pagination (opsional)
        $desas = Desa::with('kepalaDesa')
            ->orderBy('nama')
            ->paginate(20);

        return view('guest.desa.daftar_desa', compact('desas'));
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
