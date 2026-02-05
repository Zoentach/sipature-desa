<?php

namespace App\Http\Controllers;

use App\Models\PerjalananDinas;
use App\Models\Pegawai;
use App\Models\JenisPerjalanan;
use Illuminate\Http\Request;

class PerjalananDinasController extends Controller
{
    /**
     * Tampilkan daftar perjalanan dinas
     */
    public function index()
    {
        $perjalananDinas = PerjalananDinas::with(['pegawais', 'jenisPerjalanan'])
            ->latest()
            ->get();

        $pegawais = Pegawai::orderBy('nama')->get();
        $jenisPerjalanan = JenisPerjalanan::all();

        return view('admin.umum.perjalanan_dinas.index', compact(
            'perjalananDinas',
            'pegawais',
            'jenisPerjalanan'
        ));
    }

    public function tambah()
    {
        $pegawais = Pegawai::orderBy('nama')->get();
        $jenisPerjalanan = JenisPerjalanan::all();

        // ambil data perjalanan terakhir
        $last = PerjalananDinas::orderByDesc('id')->first();

        // default awal
        $nextNomor = '800.1.11.1/01/' . date('Y');

        if ($last && $last->nomor_spt) {

            // contoh: 800.1.11.1/09/2026
            $parts = explode('/', $last->nomor_spt);

            if (count($parts) === 3) {
                $kode = $parts[0];          // 800.1.11.1
                $urut = (int)$parts[1];    // 9
                $tahun = $parts[2];          // 2026

                if ($tahun == date('Y')) {
                    $urut++;
                } else {
                    $urut = 1;
                    $tahun = date('Y');
                }

                $nextNomor = $kode . '/'
                    . str_pad($urut, 2, '0', STR_PAD_LEFT)
                    . '/' . $tahun;
            }
        }

        return view('admin.umum.perjalanan_dinas.tambah', compact(
            'pegawais',
            'jenisPerjalanan',
            'nextNomor'
        ));
    }


    /**
     * Simpan data perjalanan dinas baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_perjalanan_id' => 'required|exists:jenis_perjalanan,id',
            'nomor_spt' => 'required|string|max:100',
            'maksud_tujuan' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_berangkat',
            'lama_hari' => 'required|integer|min:1',
            'pegawai_ids' => 'required|array|min:1',
            'pegawai_ids.*' => 'exists:pegawai,id',
        ]);

        $perjalanan = PerjalananDinas::create([
            'jenis_perjalanan_id' => $request->jenis_perjalanan_id,
            'nomor_spt' => $request->nomor_spt,
            'maksud_tujuan' => $request->maksud_tujuan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lama_hari' => $request->lama_hari,
            'status' => 'draft',
        ]);

        // simpan pegawai (pivot)
        $perjalanan->pegawais()->attach($request->pegawai_ids);

        return redirect()
            ->route('perjalanan-dinas.index')
            ->with('success', 'Perjalanan dinas berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit (tetap pakai index.php)
     */
    /**
     * Tampilkan form edit
     */
    public function edit($id)
    {
        // Mengambil data perjalanan beserta relasi pegawai (untuk auto-select nanti)
        $perjalanan = PerjalananDinas::with('pegawais')->findOrFail($id);

        $pegawais = Pegawai::orderBy('nama')->get();
        $jenisPerjalanan = JenisPerjalanan::all();

        // Arahkan ke file view edit yang terpisah agar lebih bersih
        return view('admin.umum.perjalanan_dinas.edit', compact(
            'perjalanan',
            'pegawais',
            'jenisPerjalanan'
        ));
    }

    /**
     * Update perjalanan dinas
     */
    public function update(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'jenis_perjalanan_id' => 'required|exists:jenis_perjalanan,id',
            // Validasi unik nomor SPT, tapi kecualikan ID yang sedang diedit ini
            'nomor_spt' => [
                'required',
                'string',
                'max:100',
                Rule::unique('perjalanan_dinas', 'nomor_spt')->ignore($id)
            ],
            'maksud_tujuan' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_berangkat',
            'lama_hari' => 'required|integer|min:1',
            'status' => 'required|in:draft,disetujui,selesai',

            // Validasi Array Pegawai
            'pegawai_ids' => 'required|array|min:1',
            'pegawai_ids.*' => 'exists:pegawai,id',
        ]);

        $perjalanan = PerjalananDinas::findOrFail($id);

        // Update data utama
        $perjalanan->update([
            'jenis_perjalanan_id' => $request->jenis_perjalanan_id,
            'nomor_spt' => $request->nomor_spt,
            'maksud_tujuan' => $request->maksud_tujuan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lama_hari' => $request->lama_hari,
            'status' => $request->status,
        ]);

        // Sync Pegawai (Penting: sync() akan menghapus yang tidak dicentang dan menambah yang baru)
        $perjalanan->pegawais()->sync($request->pegawai_ids);

        return redirect()
            ->route('perjalanan-dinas.index')
            ->with('success', 'Data perjalanan dinas berhasil diperbarui.');
    }

    /**
     * Hapus perjalanan dinas
     */
    public function destroy($id)
    {
        $perjalanan = PerjalananDinas::findOrFail($id);
        $perjalanan->delete();

        return redirect()
            ->route('perjalanan-dinas.index')
            ->with('success', 'Perjalanan dinas berhasil dihapus');
    }
}
