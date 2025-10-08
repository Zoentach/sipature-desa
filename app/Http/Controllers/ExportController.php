<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Export data user dan perangkat desa berdasarkan kode_desa
     * lalu kirim ke browser sebagai file JSON download.
     */
    public function exportByDesa($kode_desa)
    {
        // Ambil user berdasarkan kode_desa
        $users = User::where('kode_desa', $kode_desa)->get([
            'name', 'email', 'password', 'kode_desa', 'kode_kecamatan'
        ]);

        // Ambil perangkat desa berdasarkan kode_desa
        $perangkat = PerangkatDesa::where('kode_desa', $kode_desa)->get([
            'id', 'nama', 'nipd', 'kode_kecamatan', 'kode_desa', 'kode_jabatan', 'mulai',
            'berakhir', 'nik', 'tempat_lahir', 'tanggal_lahir', 'sk_id',
            'pendidikan_id', 'jenis_kelamin', 'agama', 'no_telp', 'status'
        ]);

        // Gabungkan dalam 1 struktur JSON
        $data = [
            'users' => $users,
            'perangkat_desa' => $perangkat
        ];

        // Encode ke JSON dengan format rapi
        $json = json_encode($data, JSON_PRETTY_PRINT);

        // Buat nama file dinamis
        $fileName = "export_desa_{$kode_desa}.json";

        // Simpan sementara ke storage
        $path = storage_path("app/{$fileName}");
        file_put_contents($path, $json);

        // Kirim sebagai download ke browser
        return response()->download($path, $fileName, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
        ]);
    }
}
