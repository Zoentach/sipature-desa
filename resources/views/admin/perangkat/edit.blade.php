@extends('admin.dashboard')

@section('content')

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Ubah Data Perangkat Desa</h2>
            <a href="{{ route('perangkat_desa.index') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm">Kembali</a>
        </div>

        <!-- PERHATIKAN: Route diarahkan ke update dan tambahkan metode PUT -->
        <form action="{{ route('perangkat_desa.update', $perangkat->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $perangkat->nama) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik', $perangkat->nik) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nik') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">NIPD</label>
                    <input type="text" name="nipd" value="{{ old('nipd', $perangkat->nipd) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nipd') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <select name="kode_jabatan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="PD01" {{ old(
                        'kode_jabatan', $perangkat->kode_jabatan) == 'PD01' ? 'selected' : '' }}>Kepala Desa</option>
                        <option value="PD02" {{ old(
                        'kode_jabatan', $perangkat->kode_jabatan) == 'PD02' ? 'selected' : '' }}>Sekretaris
                        Desa</option>
                        <option value="PD03" {{ old(
                        'kode_jabatan', $perangkat->kode_jabatan) == 'PD03' ? 'selected' : '' }}>Kaur Umum dan
                        Perencanaan</option>
                        <option value="PD04" {{ old(
                        'kode_jabatan', $perangkat->kode_jabatan) == 'PD04' ? 'selected' : '' }}>Kaur Keuangan</option>
                        <option value="PD06" {{ old(
                        'kode_jabatan', $perangkat->kode_jabatan) == 'PD06' ? 'selected' : '' }}>Kasi
                        Pemerintahan</option>
                        <option value="PD78" {{ old(
                        'kode_jabatan', $perangkat->kode_jabatan) == 'PD78' ? 'selected' : '' }}>Kasi Kesejahteraan dan
                        Pelayanan</option>
                        <option value="PD09" {{ old(
                        'kode_jabatan', $perangkat->kode_jabatan) == 'PD09' ? 'selected' : '' }}>Kepala Dusun</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status Jabatan</label>
                    <select name="status_jabatan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="Definitif" {{ old(
                        'status_jabatan', $perangkat->status_jabatan) == 'Definitif' ? 'selected' : ''
                        }}>Definitif</option>
                        <option value="Pelaksana Tugas" {{ old(
                        'status_jabatan', $perangkat->status_jabatan) == 'Pelaksana Tugas' ? 'selected' : ''
                        }}>Pelaksana Tugas</option>
                        <option value="Pelaksana Harian" {{ old(
                        'status_jabatan', $perangkat->status_jabatan) == 'Pelaksana Harian' ? 'selected' : ''
                        }}>Pelaksana Harian</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status Keaktifan</label>
                    <select name="status_keaktifan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="Aktif" {{ old(
                        'status_keaktifan', $perangkat->status_keaktifan) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ old(
                        'status_keaktifan', $perangkat->status_keaktifan) == 'Nonaktif' ? 'selected' : ''
                        }}>Nonaktif</option>
                        <option value="Berhenti" {{ old(
                        'status_keaktifan', $perangkat->status_keaktifan) == 'Berhenti' ? 'selected' : ''
                        }}>Berhenti</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode Kecamatan</label>
                    <input type="text" name="kode_kecamatan"
                           value="{{ old('kode_kecamatan', $perangkat->kode_kecamatan) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode Desa</label>
                    <input type="text" name="kode_desa" value="{{ old('kode_desa', $perangkat->kode_desa) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-md shadow">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
