<?php

namespace App\Http\Controllers;

use App\Models\IndeksDesa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\IndeksDesaImport;

// Class ini akan kita buat di tahap selanjutnya
use Illuminate\Validation\Rule;
use App\Enums\StatusDesa;

// Pastikan namespace Enum ini sesuai dengan project Anda

class IndeksDesaController extends Controller
{
    /**
     * Menampilkan halaman daftar data Indeks Desa.
     */
    public function index(Request $request)
    {
        // Mengambil data dengan pagination (misal 10 data per halaman)
        // Anda bisa menambahkan fitur pencarian (search) di sini jika diperlukan nanti
        $indeks_desa = IndeksDesa::paginate(10);

        return view('indeks_desa.index', compact('indeks_desa'));
    }

    /**
     * Tampilan untuk ADMIN (Tabel data + Tombol Import & Edit)
     */
    public function adminIndex(Request $request)
    {
        $indeks_desa = IndeksDesa::paginate(10);
        // Mengarah ke view admin
        return view('admin.indeks_desa.index', compact('indeks_desa'));
    }

    /**
     * Menampilkan halaman form edit.
     */
    public function edit(IndeksDesa $indeksDesa)
    {
        // Mengirim data desa yang dipilih dan daftar status enum ke view
        $statuses = StatusDesa::cases();

        return view('admin.indeks_desa.edit', compact('indeksDesa', 'statuses'));
    }

    /**
     * Memproses pembaruan data ke database.
     */
    public function update(Request $request, IndeksDesa $indeksDesa)
    {
        // Validasi data yang diinputkan
        $validated = $request->validate([
            'kode_desa' => 'required|string|max:255',
            'kode_kecamatan' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'skor_iks' => 'required|numeric|min:0',
            'skor_ike' => 'required|numeric|min:0',
            'skor_ikl' => 'required|numeric|min:0',
            'skor_idm' => 'required|numeric|min:0',
            'status_desa' => ['required', Rule::enum(StatusDesa::class)],
        ]);

        // Melakukan update data
        $indeksDesa->update($validated);

        // Mengembalikan pengguna ke halaman index dengan pesan sukses
        return redirect()->route('admin.indeks_desa.index')
            ->with('success', 'Data Indeks Desa berhasil diperbarui.');
    }

    /**
     * Memproses file Excel untuk di-import menggunakan Maatwebsite.
     */
    public function import(Request $request)
    {
        // Validasi file yang diunggah harus berekstensi xlsx, xls, atau csv
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:10240', // Maksimal 10MB
        ]);

        try {
            // Proses import data menggunakan class IndeksDesaImport
            Excel::import(new IndeksDesaImport, $request->file('file_excel'));

            return redirect()->route('admin.indeks_desa.index')
                ->with('success', 'Data Indeks Desa berhasil diimport.');
        } catch (\Exception $e) {
            // Menangkap error jika format Excel salah atau ada masalah lain
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }
}
