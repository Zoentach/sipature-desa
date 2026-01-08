<?php

namespace App\Http\Controllers;

use App\Models\JenisRegulasi;
use App\Models\Regulasi;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class RegulasiController extends Controller
{
    public function index()
    {
        return view('admin.umum.regulasi.index');
    }


    public function tambah()
    {
        return view('admin.umum.regulasi.tambah', [
            'jenisRegulasi' => JenisRegulasi::orderBy('nama_regulasi')->get(),
            'unitKerja' => UnitKerja::orderBy('nama_unit')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // 1️⃣ Validasi
        $validated = $request->validate([
            'jenis_regulasi_id' => 'required|exists:jenis_regulasi,id',
            'nomor_regulasi' => 'required|string|max:50',
            'tahun' => 'required|digits:4|integer',
            'tentang' => 'required|string',
            'unit_kerja_id' => 'required|exists:unit_kerja,id',
            'file_dokumen' => 'required|file|mimes:pdf|max:10240', // 10MB
        ]);

        // 2️⃣ Upload file PDF
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');

            $namaFile = 'regulasi_'
                . time() . '_'
                . str()->slug($validated['nomor_regulasi'])
                . '.pdf';

            $path = $file->storeAs(
                'regulasi',
                $namaFile,
                'public'
            );

            $validated['file_dokumen'] = $path;
        }

        // 3️⃣ Simpan ke database
        Regulasi::create($validated);

        // 4️⃣ Redirect
        return redirect()
            ->route('regulasi.index')
            ->with('success', 'Regulasi berhasil disimpan');
    }

}
