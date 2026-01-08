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
    public function edit($id)
    {
        $editData = PerjalananDinas::with('pegawais')->findOrFail($id);

        $perjalananDinas = PerjalananDinas::with(['pegawais', 'jenisPerjalanan'])
            ->latest()
            ->get();

        $pegawais = Pegawai::orderBy('nama')->get();
        $jenisPerjalanan = JenisPerjalanan::all();

        return view('perjalanan_dinas.index', compact(
            'perjalananDinas',
            'pegawais',
            'jenisPerjalanan',
            'editData'
        ));
    }

    /**
     * Update perjalanan dinas
     */
    public function update(Request $request, $id)
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
            'status' => 'required|in:draft,disetujui,selesai',
        ]);

        $perjalanan = PerjalananDinas::findOrFail($id);

        $perjalanan->update([
            'jenis_perjalanan_id' => $request->jenis_perjalanan_id,
            'nomor_spt' => $request->nomor_spt,
            'maksud_tujuan' => $request->maksud_tujuan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lama_hari' => $request->lama_hari,
            'status' => $request->status,
        ]);

        // sync pegawai (hapus & tambah otomatis)
        $perjalanan->pegawais()->sync($request->pegawai_ids);

        return redirect()
            ->route('perjalanan-dinas.index')
            ->with('success', 'Perjalanan dinas berhasil diperbarui');
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
