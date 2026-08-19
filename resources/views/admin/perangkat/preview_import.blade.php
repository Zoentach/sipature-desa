@extends('admin.dashboard')

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Pratinjau Data Import</h2>
            <a href="{{ route('perangkat_desa.import') }}" class="text-red-500 hover:text-red-700 font-medium text-sm">Batalkan</a>
        </div>

        <div class="p-6">
            <div class="mb-4 bg-yellow-50 text-yellow-800 p-4 rounded-md border border-yellow-200">
                <strong>Penting:</strong> Data di bawah ini belum disimpan ke database. Mohon periksa kembali.
                Jika ada baris bertanda <span class="text-red-600 font-bold">Merah</span>, berarti sistem gagal
                mendeteksinya. Silakan cek ulang file Excel Anda jika hal tersebut tidak sesuai harapan.
            </div>

            <div class="overflow-x-auto border rounded">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600">Nama Lengkap</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600">Jabatan di Excel &rarr; Kode
                            Database
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600">Desa di Excel &rarr; Kode
                            Database
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600">NIK</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600">No. HP</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($previewData as $row)
                    <tr>
                        <td class="px-4 py-2 text-sm">{{ $row['nama'] }}</td>
                        <td class="px-4 py-2 text-sm">
                            {{ $row['jabatan_excel'] }} &rarr;
                            @if($row['kode_jabatan'])
                            <span class="text-green-600 font-bold">{{ $row['kode_jabatan'] }}</span>
                            @else
                            <span class="text-red-500 font-bold">Tidak Terdeteksi</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-sm">
                            {{ $row['desa_excel'] }} &rarr;
                            @if($row['kode_desa'])
                            <span class="text-green-600 font-bold">{{ $row['kode_desa'] }}</span>
                            @else
                            <span class="text-red-500 font-bold">Tidak Ditemukan</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-sm">{{ $row['nik'] }}</td>
                        <td class="px-4 py-2 text-sm">{{ $row['no_telp'] ?? '-' }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('perangkat_desa.import') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-md shadow-sm">
                    Batal & Upload Ulang
                </a>

                <!-- Form Konfirmasi -->
                <form action="{{ route('perangkat_desa.confirm_import') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-sm">
                        Ya, Data Sudah Benar & Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endSection
