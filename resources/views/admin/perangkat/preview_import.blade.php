@extends('admin.dashboard')

@section('title', 'Pratinjau Data Import - Sipature Desa')

@section('content')
<div class="w-full max-w-7xl mx-auto">

    <!-- HEADER HALAMAN -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-900 tracking-tight">
                Pratinjau Data Import
            </h2>
            <p class="text-gray-500 text-sm mt-1 font-medium">
                Periksa kembali data sebelum disimpan ke database.
            </p>
        </div>

        <!-- Tombol Batalkan -->
        <div>
            <a href="{{ route('perangkat_desa.import') }}"
               class="inline-flex items-center gap-2 text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 font-bold text-sm px-5 py-2.5 rounded-xl shadow-sm transition-all hover:-translate-x-1">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18 17.94 6M18 18 6.06 6"/>
                </svg>
                Batalkan & Kembali
            </a>
        </div>
    </div>

    <!-- BOX PERINGATAN -->
    <div class="mb-8 bg-amber-50 border border-amber-200 p-5 rounded-2xl flex items-start shadow-sm">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-amber-600 bg-white rounded-full shadow-sm mr-4 mt-0.5">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
        </div>
        <div>
            <h4 class="text-sm font-extrabold text-amber-900 uppercase tracking-wider">Perhatian Penting</h4>
            <p class="text-sm text-amber-800 mt-1 font-medium">
                Data di bawah ini <strong>belum disimpan</strong> ke database. Mohon periksa kembali.
                Jika terdapat baris dengan status <span class="bg-red-200 text-red-900 px-2 py-0.5 rounded font-bold">Tidak Terdeteksi</span>,
                mohon sesuaikan kembali data pada file Excel Anda agar sistem dapat mengenalinya.
            </p>
        </div>
    </div>

    <!-- TABEL PRATINJAU -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-emerald-900 uppercase bg-emerald-50 border-b border-gray-100 font-bold">
                <tr>
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Jabatan (Excel → Database)</th>
                    <th class="px-6 py-4">Desa (Excel → Database)</th>
                    <th class="px-6 py-4">NIK</th>
                    <th class="px-6 py-4 text-center">No. HP</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @foreach($previewData as $row)
                <tr class="hover:bg-emerald-50/30 transition-colors bg-white">
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $row['nama'] }}</td>

                    <!-- Jabatan -->
                    <td class="px-6 py-4">
                        <div class="flex flex-col text-xs">
                            <span class="text-gray-500 font-medium">{{ $row['jabatan_excel'] }}</span>
                            @if($row['kode_jabatan'])
                            <span class="text-emerald-700 font-bold">→ {{ $row['kode_jabatan'] }}</span>
                            @else
                            <span class="text-red-600 font-bold">→ Tidak Terdeteksi</span>
                            @endif
                        </div>
                    </td>

                    <!-- Desa -->
                    <td class="px-6 py-4">
                        <div class="flex flex-col text-xs">
                            <span class="text-gray-500 font-medium">{{ $row['desa_excel'] }}</span>
                            @if($row['kode_desa'])
                            <span class="text-emerald-700 font-bold">→ {{ $row['kode_desa'] }}</span>
                            @else
                            <span class="text-red-600 font-bold">→ Tidak Ditemukan</span>
                            @endif
                        </div>
                    </td>

                    <td class="px-6 py-4 font-mono text-gray-600">{{ $row['nik'] }}</td>
                    <td class="px-6 py-4 text-center text-gray-600">{{ $row['no_telp'] ?? '-' }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- FOOTER TOMBOL -->
        <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
            <a href="{{ route('perangkat_desa.import') }}"
               class="px-6 py-3 text-sm font-bold text-gray-700 bg-white hover:bg-gray-100 border border-gray-200 rounded-xl transition-all">
                Upload Ulang
            </a>

            <form action="{{ route('perangkat_desa.confirm_import') }}" method="POST">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl shadow-md transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 11.917 9.724 16.5 19 7.5"/>
                    </svg>
                    Simpan Data ke Database
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
