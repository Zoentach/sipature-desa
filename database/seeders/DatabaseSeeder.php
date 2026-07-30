<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. DATA MASTER DASAR
        DB::table('unit_kerja')->insert([
            ['id' => 1, 'nama_unit' => 'Pemerintahan Desa', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'nama_unit' => 'Pemberdayaan Ekonomi', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'nama_unit' => 'Pemberdayaan Kelembagaan', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('desa')->insert([
            ['id' => 1, 'nama' => 'Janji Mauli', 'kode_desa' => '1271012001', 'kode_kecamatan' => '127101', 'tahun_berdiri' => '2005']
        ]);

        DB::table('jenis_perjalanan')->insert([
            ['id' => 1, 'nama' => 'Evaluasi Kinerja Desa', 'created_at' => $now, 'updated_at' => $now]
        ]);

        // 2. DATA USER & PEGAWAI
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Munandar Simanjuntak',
                'email' => 'admin@jejakdesa.id',
                'password' => Hash::make('password123'),
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        DB::table('pegawai')->insert([
            [
                'id' => 1,
                'nip' => '199001012024211001',
                'nama' => 'Munandar Simanjuntak',
                'jabatan' => 'Pranata Komputer Ahli Pertama',
                'user_id' => 1,
                'unit_kerja_id' => 1,
                'golongan' => 'III/a',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        // 3. DATA INSTRUMEN FORM
        DB::table('kelompok_instrumen')->insert([
            ['id' => 1, 'unit_kerja_id' => 1, 'nama_kelompok' => '1. Kondisi Kantor Desa', 'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'unit_kerja_id' => 1, 'nama_kelompok' => '2. Dokumen Administrasi Desa', 'urutan' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'unit_kerja_id' => 2, 'nama_kelompok' => '1. Keberadaan BUMDesa', 'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'unit_kerja_id' => 3, 'nama_kelompok' => '1. Tim Penggerak PKK', 'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('instrumen_evaluasi')->insert([
            ['id' => 1, 'kelompok_id' => 1, 'uraian_tugas' => 'a. Bangunan', 'tipe_jawaban' => 'KONDISI_FISIK', 'urutan' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'kelompok_id' => 1, 'uraian_tugas' => 'b. Ruangan', 'tipe_jawaban' => 'KONDISI_FISIK', 'urutan' => 2, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'kelompok_id' => 2, 'uraian_tugas' => 'a. Dokumen Perencanaan', 'tipe_jawaban' => 'KETERSEDIAAN', 'urutan' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'kelompok_id' => 3, 'uraian_tugas' => 'a. Legalitas Pembentukan', 'tipe_jawaban' => 'KETERSEDIAAN', 'urutan' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'kelompok_id' => 3, 'uraian_tugas' => 'b. Peraturan Desa', 'tipe_jawaban' => 'KETERSEDIAAN', 'urutan' => 2, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'kelompok_id' => 4, 'uraian_tugas' => 'a. SK Pengangkatan', 'tipe_jawaban' => 'KETERSEDIAAN', 'urutan' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 4. DATA PERJALANAN DINAS (SPT) & TIM
        DB::table('perjalanan_dinas')->insert([
            [
                'id' => 1,
                'jenis_perjalanan_id' => 1,
                'nomor_spt' => '800.1.11.1/836/2026',
                'maksud_tujuan' => 'Dalam rangka evaluasi kegiatan ketapang di Desa Janji Mauli Kecamatan Sipirok',
                'tanggal_berangkat' => '2026-07-20',
                'tanggal_kembali' => '2026-07-21',
                'lama_hari' => 2,
                'status' => 'disetujui',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        DB::table('perjalanan_dinas_pegawai')->insert([
            ['perjalanan_dinas_id' => 1, 'pegawai_id' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 5. TRANSAKSI LAPORAN (Mengacu pada SPT di atas)
        DB::table('hasil_evaluasi')->insert([
            [
                'id' => 1,
                'desa_id' => 1,
                'perjalanan_dinas_id' => 1,
                'user_pelapor_id' => 1,
                'tanggal_evaluasi' => '2026-07-21',
                'status' => 'SELESAI',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        // 6. DETAIL JAWABAN (Mengacu pada id Laporan di atas)
        DB::table('detail_hasil_evaluasi')->insert([
            ['hasil_evaluasi_id' => 1, 'instrumen_id' => 1, 'nilai_opsi' => 'Baik', 'catatan' => null, 'created_at' => $now, 'updated_at' => $now],
            ['hasil_evaluasi_id' => 1, 'instrumen_id' => 2, 'nilai_opsi' => 'Kurang Baik', 'catatan' => 'Plafon ruangan bocor', 'created_at' => $now, 'updated_at' => $now],
            ['hasil_evaluasi_id' => 1, 'instrumen_id' => 3, 'nilai_opsi' => 'Ada', 'catatan' => null, 'created_at' => $now, 'updated_at' => $now],
            ['hasil_evaluasi_id' => 1, 'instrumen_id' => 4, 'nilai_opsi' => 'Ada', 'catatan' => null, 'created_at' => $now, 'updated_at' => $now],
            ['hasil_evaluasi_id' => 1, 'instrumen_id' => 5, 'nilai_opsi' => 'Tidak Ada', 'catatan' => 'Sedang dalam tahap penyusunan draft', 'created_at' => $now, 'updated_at' => $now],
            ['hasil_evaluasi_id' => 1, 'instrumen_id' => 6, 'nilai_opsi' => 'Ada', 'catatan' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

