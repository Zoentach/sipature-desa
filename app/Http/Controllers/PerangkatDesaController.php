<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\PerangkatDesa;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PerangkatDesaPreviewImport;
use Carbon\Carbon;

class PerangkatDesaController extends Controller
{
    /**
     * Menampilkan halaman index perangkat desa (menggunakan Livewire)
     */
    public function index()
    {
        return view('admin.perangkat.index');
    }

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
            ->where('status_jabatan', 'Definitif')
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

        // Ambil data verifikasi terbaru dari user
        $verifikasi = \App\Models\VerifikasiAbsensi::where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$verifikasi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data verifikasi tidak ditemukan. Silakan lakukan verifikasi terlebih dahulu.'
            ], 403);
        }

        // Ambil perangkat berdasarkan kode desa dari verifikasi
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
        return view('admin.perangkat.tambah');
    }

    /**
     * Simpan data perangkat ke database (Tambah Data Manual)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nipd' => 'nullable|string|max:30|unique:perangkat_desa,nipd',
            'nik' => 'nullable|string|max:30|unique:perangkat_desa,nik',
            'kode_kecamatan' => 'nullable|string|max:20',
            'kode_desa' => 'nullable|string|max:20',
            'kode_jabatan' => 'nullable|string|max:10',
            'grup_jabatan' => 'nullable|string|max:50',
            'mulai' => 'nullable|date',
            'berakhir' => 'nullable|date|after_or_equal:mulai',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'sk_id' => 'nullable|integer',
            'pendidikan_id' => 'nullable|integer',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu',
            'no_telp' => 'nullable|string|max:20',
            'status_jabatan' => 'nullable|in:Definitif,Pelaksana Tugas,Pelaksana Harian,Kosong',
            'status_keaktifan' => 'nullable|in:Aktif,Nonaktif,Pensiun,Berhenti',
        ]);

        PerangkatDesa::create($validated);

        return redirect()
            ->route('perangkat_desa.create')
            ->with('success', 'Data perangkat desa berhasil disimpan!');
    }

    /**
     * Form edit perangkat
     */
    public function edit($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        return view('admin.perangkat.edit', compact('perangkat'));
    }

    /**
     * Update data perangkat ke database
     */
    public function update(Request $request, $id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            // Ignore validasi unique untuk data yang sedang diubah
            'nipd' => 'nullable|string|max:30|unique:perangkat_desa,nipd,' . $perangkat->id,
            'nik' => 'nullable|string|max:30|unique:perangkat_desa,nik,' . $perangkat->id,
            'kode_kecamatan' => 'nullable|string|max:20',
            'kode_desa' => 'nullable|string|max:20',
            'kode_jabatan' => 'nullable|string|max:10',
            'grup_jabatan' => 'nullable|string|max:50',
            'mulai' => 'nullable|date',
            'berakhir' => 'nullable|date|after_or_equal:mulai',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'sk_id' => 'nullable|integer',
            'pendidikan_id' => 'nullable|integer',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu',
            'no_telp' => 'nullable|string|max:20',
            'status_jabatan' => 'nullable|in:Definitif,Pelaksana Tugas,Pelaksana Harian,Kosong',
            'status_keaktifan' => 'nullable|in:Aktif,Nonaktif,Pensiun,Berhenti',
        ]);

        $perangkat->update($validated);

        return redirect()
            ->route('perangkat_desa.index')
            ->with('success', 'Data perangkat desa berhasil diubah!');
    }

    /**
     * Halaman form import excel
     */
    public function import()
    {
        return view('admin.perangkat.import');
    }

    /**
     * Proses Baca Excel dan Jadikan Preview (Belum Masuk Database)
     */
    public function processImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ], [
            'file.required' => 'File Excel wajib diunggah.',
            'file.mimes' => 'Format file harus berupa .xlsx, .xls, atau .csv.',
        ]);

        try {
            // 1. Baca sheet Excel menjadi Collection (pastikan headingRow() di class Import sudah di-set)
            $dataExcel = Excel::toCollection(new PerangkatDesaPreviewImport, $request->file('file'))->first();

            $previewData = [];

            // 2. Terjemahkan data Excel per baris
            foreach ($dataExcel as $row) {
                // Abaikan baris yang nama-nya kosong
                if (!isset($row['nama']) || trim($row['nama']) == '') {
                    continue;
                }

                // --- A. TERJEMAHAN JABATAN ---
                $namaJabatanExcel = trim(str_replace('.', '', $row['jabatan'] ?? ''));
                $kodeJabatan = match (strtolower($namaJabatanExcel)) {
                    'kepala desa' => 'PD01',
                    'sekretaris desa' => 'PD02',
                    'kaur umum dan perencanaan' => 'PD03',
                    'kaur keuangan' => 'PD04',
                    'kaur perencanaan' => 'PD05',
                    'kasi pemerintahan' => 'PD06',
                    'kasi kesejahteraan' => 'PD07',
                    'kasi pelayanan' => 'PD08',
                    'kasi kesejahteraan dan pelayanan' => 'PD78',
                    'kepala dusun' => 'PD09',
                    default => null,
                };

                $grupJabatan = null;
                if (in_array($kodeJabatan, ['PD01', 'PD02'])) {
                    $grupJabatan = '01';
                } elseif ($kodeJabatan) {
                    $grupJabatan = '02';
                }

                // --- B. VALIDASI GANDA (KECAMATAN & DESA) ---
                $namaKecamatanExcel = trim($row['kecamatan'] ?? '');
                $namaDesaMentah = trim($row['nama_desa'] ?? '');

                // Pembersihan teks desa berjaga-jaga jika ada angka "11. Haunatas"
                $namaDesaBersih = trim(preg_replace('/^[0-9]+\.\s*/', '', $namaDesaMentah));

                // Tahap 1: Cari Kecamatan berdasarkan nama (Exact Match / pencarian tepat)
                $kecamatan = Kecamatan::where('nama', $namaKecamatanExcel)->first();
                $kodeKec = $kecamatan ? $kecamatan->kode_kecamatan : null;

                // Tahap 2: Cari Desa berdasarkan nama persis DAN Kode Kecamatan dari Tahap 1
                $desa = null;
                if ($kodeKec) {
                    $desa = Desa::where('nama', $namaDesaBersih)
                        ->where('kode_kecamatan', $kodeKec)
                        ->first();
                }

                // --- C. BERSIHKAN DATA LAINNYA ---
                $jenisKelamin = isset($row['jenis_kelamin_lp']) ? strtoupper(trim($row['jenis_kelamin_lp'])) : null;
                if (!in_array($jenisKelamin, ['L', 'P'])) {
                    $jenisKelamin = null;
                }

                // 3. Masukkan hasil olahan ke array preview
                $previewData[] = [
                    'nama' => $row['nama'],
                    'nipd' => $row['nipd'] ?? null,
                    'nik' => $row['nik'] ?? null,

                    // Kolom pembantu untuk ditampilkan di tabel preview (TIDAK masuk DB)
                    'jabatan_excel' => $row['jabatan'] ?? '-',
                    'desa_excel' => $namaDesaBersih . ' (Kec. ' . $namaKecamatanExcel . ')',

                    // Data relasi dari hasil pencarian
                    'kode_jabatan' => $kodeJabatan,
                    'grup_jabatan' => $grupJabatan,
                    'kode_desa' => $desa ? $desa->kode_desa : null,
                    'kode_kecamatan' => $kodeKec,

                    // Data profil
                    'tempat_lahir' => $row['tempat_lahir'] ?? null,
                    'tanggal_lahir' => $this->parseTanggal($row['tanggal_lahir'] ?? null),
                    'jenis_kelamin' => $jenisKelamin,
                    'no_telp' => $row['no_hpwa'] ?? null,
                    'status_jabatan' => 'Definitif',
                    'status_keaktifan' => 'Aktif',
                ];
            }

            // 4. Simpan ke Session
            session(['import_preview_data' => $previewData]);

            return view('admin.perangkat.preview_import', compact('previewData'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan pembacaan file: ' . $e->getMessage());
        }
    }

    /**
     * Mengeksekusi simpan ke Database setelah user konfirmasi di halaman Preview
     */
    public function confirmImport()
    {
        $data = session('import_preview_data');

        if (!$data) {
            return redirect()->route('perangkat_desa.import')->with('error', 'Sesi import Anda telah habis. Silakan upload ulang.');
        }

        foreach ($data as $row) {
            // Hapus atribut yang cuma buat pajangan preview agar tidak error "Unknown Column"
            unset($row['jabatan_excel']);
            unset($row['desa_excel']);

            // Insert ke database (abaikan jika ada NIK duplikat untuk mencegah error)
            PerangkatDesa::updateOrCreate(
            // Cek data berdasarkan NIK (jika ada NIK, perbarui. Jika tidak, tambah baru)
                ['nik' => $row['nik'], 'nama' => $row['nama']],
                $row
            );
        }

        // Hapus session
        session()->forget('import_preview_data');

        return redirect()->route('perangkat_desa.index')->with('success', 'Data Perangkat Desa berhasil diimport secara massal!');
    }

    /**
     * Fungsi Helper untuk membersihkan format tanggal Excel menjadi format MySQL (Y-m-d)
     * Contoh: "14/05/91" -> "1991-05-14" atau "08 Mei 2024" -> "2024-05-08"
     */
    private function parseTanggal($tanggal)
    {
        if (!$tanggal) return null;

        try {
            // Jika terbaca sebagai angka seri Excel (misal: 44000)
            if (is_numeric($tanggal)) {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tanggal))->format('Y-m-d');
            }

            // Konversi bulan Indonesia ke format inggris agar bisa diparse Carbon
            $bulanIndo = ['januari' => 'jan', 'februari' => 'feb', 'maret' => 'mar', 'april' => 'apr', 'mei' => 'may', 'juni' => 'jun', 'juli' => 'jul', 'agustus' => 'aug', 'september' => 'sep', 'oktober' => 'oct', 'november' => 'nov', 'desember' => 'dec'];
            $tanggalBerdih = str_ireplace(array_keys($bulanIndo), array_values($bulanIndo), $tanggal);

            // Format 14/05/91 (asumsi 1991, bukan 2091)
            if (preg_match('/^\d{2}\/\d{2}\/\d{2}$/', $tanggal)) {
                return Carbon::createFromFormat('d/m/y', $tanggal)->format('Y-m-d');
            }

            return Carbon::parse($tanggalBerdih)->format('Y-m-d');
        } catch (\Exception $e) {
            // Jika tanggal tidak bisa dibaca sama sekali, kembalikan null
            return null;
        }
    }
}
