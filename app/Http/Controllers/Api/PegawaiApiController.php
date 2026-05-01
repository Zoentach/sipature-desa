<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiApiController extends Controller
{
    /**
     * Menampilkan semua data pegawai (GET /api/pegawai)
     */
    public function index()
    {
        // Mengambil semua data pegawai, disarankan menyertakan data relasi unit kerja
        $pegawais = Pegawai::with('unitKerja')->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data pegawai',
            'data' => $pegawais
        ], 200);
    }

    /**
     * Menyimpan data pegawai baru (POST /api/pegawai)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|unique:pegawai,nip',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unit_kerja_id' => 'required|integer|exists:unit_kerja,id', // Pastikan ID ada di tabel unit_kerja
            'golongan' => 'required|string|max:50',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Simpan Data
        $pegawai = Pegawai::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil ditambahkan',
            'data' => $pegawai
        ], 201);
    }

    /**
     * Mengubah data pegawai (PUT/PATCH /api/pegawai/{id})
     */
    public function update(Request $request, $id)
    {
        // 1. Cari data pegawai
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data pegawai tidak ditemukan'
            ], 404);
        }

        // 2. Validasi Input (pengecualian unique NIP untuk ID yang sedang diupdate)
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|unique:pegawai,nip,' . $id,
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unit_kerja_id' => 'required|integer|exists:unit_kerja,id',
            'golongan' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // 3. Update Data
        $pegawai->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil diperbarui',
            'data' => $pegawai
        ], 200);
    }

    /**
     * Menghapus data pegawai (DELETE /api/pegawai/{id})
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data pegawai tidak ditemukan'
            ], 404);
        }

        $pegawai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil dihapus'
        ], 200);
    }
}
