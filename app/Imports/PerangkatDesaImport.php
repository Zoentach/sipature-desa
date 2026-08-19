//<?php
//
//namespace App\Imports;
//
//use App\Models\PerangkatDesa;
//use Maatwebsite\Excel\Concerns\ToModel;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;
//
//class PerangkatDesaImport implements ToModel, WithHeadingRow
//{
//    /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//    public function model(array $row)
//    {
//        // Pastikan nama key array ('nama', 'nik', dll)
//        // sama persis dengan nama kolom/header di file Excel Anda (huruf kecil semua)
//        return new PerangkatDesa([
//            'nama' => $row['nama'] ?? null,
//            'nipd' => $row['nipd'] ?? null,
//            'nik' => $row['nik'] ?? null,
//            'kode_kecamatan' => $row['kode_kecamatan'] ?? null,
//            'kode_desa' => $row['kode_desa'] ?? null,
//            'kode_jabatan' => $row['kode_jabatan'] ?? null,
//            'grup_jabatan' => $row['grup_jabatan'] ?? null,
//            'status_jabatan' => $row['status_jabatan'] ?? 'Definitif',
//            'status_keaktifan' => $row['status_keaktifan'] ?? 'Aktif',
//            'jenis_kelamin' => $row['jenis_kelamin'] ?? null,
//            'agama' => $row['agama'] ?? null,
//            'no_telp' => $row['no_telp'] ?? null,
//        ]);
//    }
//}
