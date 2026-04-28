<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PerjalananDinasApiController extends Controller
{
    /**
     * Menampilkan semua data perjalanan dinas.
     */
    public function index()
    {
        $perjalanan = PerjalananDinas::with(['pegawais', 'jenisPerjalanan'])
            ->latest()
            ->get();

        return response()->json($perjalanan, 200);
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_perjalanan_id' => 'required|exists:jenis_perjalanan,id',
            'nomor_spt' => 'required|string|unique:perjalanan_dinas,nomor_spt',
            'maksud_tujuan' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_berangkat',
            'lama_hari' => 'required|integer|min:1',
            'pegawai_ids' => 'required|array|min:1',
            'pegawai_ids.*' => 'exists:pegawai,id',
        ]);

        $perjalanan = PerjalananDinas::create([
            'jenis_perjalanan_id' => $validated['jenis_perjalanan_id'],
            'nomor_spt' => $validated['nomor_spt'],
            'maksud_tujuan' => $validated['maksud_tujuan'],
            'tanggal_berangkat' => $validated['tanggal_berangkat'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'lama_hari' => $validated['lama_hari'],
            'status' => 'draft',
        ]);

        // Simpan relasi pegawai ke tabel pivot
        $perjalanan->pegawais()->attach($request->pegawai_ids);

        return response()->json($perjalanan->load(['pegawais', 'jenisPerjalanan']), 201);
    }

    /**
     * Memperbarui data yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $perjalanan = PerjalananDinas::findOrFail($id);

        $validated = $request->validate([
            'jenis_perjalanan_id' => 'required|exists:jenis_perjalanan,id',
            'nomor_spt' => ['required', 'string', Rule::unique('perjalanan_dinas')->ignore($id)],
            'maksud_tujuan' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_berangkat',
            'lama_hari' => 'required|integer|min:1',
            'status' => 'required|in:draft,disetujui,selesai',
            'pegawai_ids' => 'required|array|min:1',
            'pegawai_ids.*' => 'exists:pegawai,id',
        ]);

        $perjalanan->update($validated);

        // Sinkronisasi data pegawai (menghapus yang lama, menambah yang baru sesuai request)
        $perjalanan->pegawais()->sync($request->pegawai_ids);

        return response()->json($perjalanan->load(['pegawais', 'jenisPerjalanan']), 200);
    }

    /**
     * Menghapus data.
     */
    public function destroy($id)
    {
        $perjalanan = PerjalananDinas::findOrFail($id);
        $perjalanan->pegawais()->detach(); // Lepas relasi pivot
        $perjalanan->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
