<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\UnitKerja;
use App\Models\HasilEvaluasi;
use App\Models\DetailHasilEvaluasi;

class EvaluasiController extends Controller
{
    /**
     * 1. API UNTUK MENGAMBIL FORM CEKLIS (GET /api/instrumen)
     * Mengirimkan data berjenjang yang sudah diformat pas untuk Jetpack Compose
     */
    public function getInstrumen()
    {
        $instrumen = UnitKerja::with(['kelompokInstrumen' => function ($q) {
            $q->orderBy('urutan', 'asc')->with(['instrumenEvaluasi' => function ($q2) {
                $q2->where('is_active', true)->orderBy('urutan', 'asc');
            }]);
        }])
            ->whereNotIn('id', [1, 2, 3])
            ->orderBy('id', 'asc')
            ->get();

        $formattedData = $instrumen->map(function ($unit) {
            return [
                'id' => $unit->id,
                'namaUnit' => $unit->nama_unit ?? '-',
                'kelompokList' => $unit->kelompokInstrumen->map(function ($kelompok) {
                    return [
                        'id' => $kelompok->id,
                        'namaKelompok' => $kelompok->nama_kelompok,
                        'instrumenList' => $kelompok->instrumenEvaluasi->map(function ($item) {
                            return [
                                'id' => $item->id,
                                'uraianTugas' => $item->uraian_tugas,
                                'tipeJawaban' => $item->tipe_jawaban // KONDISI_FISIK atau KETERSEDIAAN
                            ];
                        })
                    ];
                })
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data form instrumen',
            'data' => $formattedData
        ], 200);
    }

    /**
     * 2. API UNTUK MENYIMPAN HASIL EVALUASI DARI HP (POST /api/evaluasi)
     */
    public function store(Request $request)
    {
        // Auto capitalize status untuk menghindari error case-sensitive
        if ($request->has('status')) {
            $request->merge([
                'status' => strtoupper($request->status)
            ]);
        }

        $validator = Validator::make($request->all(), [
            'desa_id' => 'required|exists:desa,id',
            'perjalanan_dinas_id' => 'required|exists:perjalanan_dinas,id',
            'tanggal_evaluasi' => 'required|date',
            'status' => 'required|in:DRAFT,SELESAI',

            'detail_jawaban' => 'required|array',
            'detail_jawaban.*.instrumen_id' => 'required|exists:instrumen_evaluasi,id',
            'detail_jawaban.*.nilai_opsi' => 'required|string',
            'detail_jawaban.*.catatan' => 'nullable|string',
            'detail_jawaban.*.foto_bukti_url' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // CEK APAKAH DESA INI SUDAH PERNAH DIEVALUASI DIBAWAH SPT YANG SAMA
        $existingEvaluation = HasilEvaluasi::where('desa_id', $request->desa_id)
            ->where('perjalanan_dinas_id', $request->perjalanan_dinas_id)
            ->first();

        if ($existingEvaluation) {
            // Jika sudah ada, tolak dan arahkan ke riwayat
            return response()->json([
                'success' => true,
                'message' => 'Desa ini sudah dievaluasi pada tugas ini. Silakan buka menu Riwayat untuk melihat atau melakukan perubahan.',
            ], 201); // Bad Request / Conflict

        }

        DB::beginTransaction();

        try {
            // Jika belum ada, buat baru secara bersih
            $hasilEvaluasi = HasilEvaluasi::create([
                'desa_id' => $request->desa_id,
                'perjalanan_dinas_id' => $request->perjalanan_dinas_id,
                'user_pelapor_id' => auth()->user()->id,
                'tanggal_evaluasi' => $request->tanggal_evaluasi,
                'status' => $request->status,
            ]);

            $detailData = [];
            foreach ($request->detail_jawaban as $jawaban) {
                $detailData[] = [
                    'hasil_evaluasi_id' => $hasilEvaluasi->id,
                    'instrumen_id' => $jawaban['instrumen_id'],
                    'nilai_opsi' => $jawaban['nilai_opsi'],
                    'catatan' => $jawaban['catatan'] ?? null,
                    'foto_bukti_url' => $jawaban['foto_bukti_url'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DetailHasilEvaluasi::insert($detailData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Laporan evaluasi berhasil disimpan!',
                'data_id' => $hasilEvaluasi->id
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * 3. API UNTUK MENGUBAH HASIL EVALUASI (PUT /api/evaluasi/{id})
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'detail_jawaban' => 'required|array',
            // Kita butuh ID dari detail tabel untuk tahu baris mana yang diupdate
            'detail_jawaban.*.id_detail' => 'required|exists:detail_hasil_evaluasi,id',
            'detail_jawaban.*.nilai_opsi' => 'required|string',
            'detail_jawaban.*.catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cek apakah Laporan Induknya ada
        $laporan = HasilEvaluasi::find($id);
        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan'
            ], 404);
        }

        DB::beginTransaction();

        try {
            foreach ($request->detail_jawaban as $jawaban) {
                // Update per baris di tabel detail_hasil_evaluasi
                DetailHasilEvaluasi::where('id', $jawaban['id_detail'])
                    ->update([
                        'nilai_opsi' => $jawaban['nilai_opsi'],
                        'catatan' => $jawaban['catatan'] ?? null,
                        'updated_at' => now()
                    ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Laporan evaluasi berhasil diperbarui!'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan perubahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * 4. API UNTUK MELIHAT DETAIL JAWABAN EVALUASI (GET /api/evaluasi/{id})
     */
    public function show($id)
    {
        // 1. Tarik Laporan beserta relasi ke Detail, Instrumen, dan Kelompoknya
        // Pastikan nama relasi di Model HasilEvaluasi adalah 'detailHasilEvaluasi'
        // dan di DetailHasilEvaluasi adalah 'instrumen'
        $laporan = HasilEvaluasi::with([
            'desa',
            'detailHasilEvaluasi.instrumen.kelompokInstrumen'
        ])->find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan'
            ], 404);
        }

        // 2. Format Data Mengelompokkan Jawaban berdasarkan "Kelompok Instrumen"
        $groupedData = [];

        foreach ($laporan->detailHasilEvaluasi as $detail) {
            $kelompokNama = $detail->instrumen->kelompokInstrumen->nama_kelompok ?? 'Lainnya';

            // Jika kelompok ini belum ada di array, buatkan strukturnya
            if (!isset($groupedData[$kelompokNama])) {
                $groupedData[$kelompokNama] = [
                    'namaKelompok' => $kelompokNama,
                    'items' => []
                ];
            }

            // Masukkan jawaban ke dalam kelompok yang sesuai
            $groupedData[$kelompokNama]['items'][] = [
                'id_detail' => $detail->id, // ID ini yang nanti dipakai saat mode PUT/Ubah
                'pertanyaan' => $detail->instrumen->uraian_tugas,
                'nilaiOpsi' => $detail->nilai_opsi,
                'catatan' => $detail->catatan ?? ''
            ];
        }

        // 3. Susun data akhir untuk dikirim ke Android
        return response()->json([
            'success' => true,
            'data' => [
                'info_laporan' => [
                    'id_laporan' => $laporan->id,
                    'nama_desa' => $laporan->desa->nama ?? '-',
                    'tanggal_evaluasi' => $laporan->tanggal_evaluasi,
                    'status' => $laporan->status,
                ],
                // array_values digunakan untuk menghilangkan key string dari PHP agar menjadi murni List JSON
                'hasil_evaluasi' => array_values($groupedData)
            ]
        ], 200);
    }
}
