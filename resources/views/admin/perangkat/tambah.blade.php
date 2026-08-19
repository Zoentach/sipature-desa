@extends('admin.dashboard')

@section('title', 'Tambah Perangkat Desa - Sipature Desa')

@section('content')
<div class="w-full max-w-5xl mx-auto">

    <!-- HEADER HALAMAN -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-900 tracking-tight">
                Tambah Perangkat Desa
            </h2>
            <p class="text-gray-500 text-sm mt-1 font-medium">
                Masukkan data profil aparatur desa baru ke dalam sistem.
            </p>
        </div>

        <!-- Tombol Kembali -->
        <div>
            <a href="{{ route('perangkat_desa.index') }}"
               class="inline-flex items-center gap-2 text-gray-700 bg-white hover:bg-gray-50 border border-gray-200 focus:ring-4 focus:ring-gray-100 font-bold text-sm px-5 py-2.5 rounded-xl shadow-sm transition-all hover:-translate-x-1">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- KARTU FORMULIR -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <!-- Pesan Sukses -->
        @if(session('success'))
        <div class="m-6 mb-0 bg-emerald-50 border border-emerald-200 p-4 rounded-2xl flex items-center shadow-sm">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-500 bg-white rounded-full shadow-sm mr-3">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                     viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div class="text-sm font-bold text-emerald-800">{{ session('success') }}</div>
        </div>
        @endif

        <form action="{{ route('perangkat_desa.store') }}" method="POST" class="p-6 sm:p-8" autocomplete="off">
            @csrf

            <!-- BUNGKUSAN GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                <!-- 1. DATA PRIBADI (KIRI) -->
                <div class="space-y-6">
                    <h3 class="text-xs font-extrabold text-emerald-700 uppercase tracking-widest border-b border-gray-100 pb-2 mb-4">
                        Informasi Pribadi
                    </h3>

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-700">Nama Lengkap <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                               placeholder="Contoh: Ahmad Fadillah"
                               class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3 transition-all @error('nama') border-red-300 ring-red-100 @enderror">
                        @error('nama') <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-700">Nomor Induk Kependudukan
                            (NIK)</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK"
                               class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3 transition-all @error('nik') border-red-300 ring-red-100 @enderror">
                        @error('nik') <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kode Kecamatan -->
                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-700">Kode Kecamatan</label>
                        <input type="text" name="kode_kecamatan" value="{{ old('kode_kecamatan') }}"
                               placeholder="Masukkan kode kecamatan"
                               class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3 transition-all">
                    </div>

                    <!-- Kode Desa -->
                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-700">Kode Desa</label>
                        <input type="text" name="kode_desa" value="{{ old('kode_desa') }}"
                               placeholder="Masukkan kode desa"
                               class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3 transition-all">
                    </div>
                </div>

                <!-- 2. DATA JABATAN (KANAN) -->
                <div class="space-y-6">
                    <h3 class="text-xs font-extrabold text-emerald-700 uppercase tracking-widest border-b border-gray-100 pb-2 mb-4">
                        Informasi Jabatan
                    </h3>

                    <!-- NIPD -->
                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-700">NIPD</label>
                        <input type="text" name="nipd" value="{{ old('nipd') }}"
                               placeholder="Nomor Induk Perangkat Desa"
                               class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3 transition-all @error('nipd') border-red-300 ring-red-100 @enderror">
                        @error('nipd') <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-700">Jabatan <span
                                class="text-red-500">*</span></label>
                        <select name="kode_jabatan" required
                                class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3 transition-all">
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="PD01" {{ old(
                            'kode_jabatan') == 'PD01' ? 'selected' : '' }}>Kepala Desa</option>
                            <option value="PD02" {{ old(
                            'kode_jabatan') == 'PD02' ? 'selected' : '' }}>Sekretaris Desa</option>
                            <option value="PD03" {{ old(
                            'kode_jabatan') == 'PD03' ? 'selected' : '' }}>Kaur Umum dan Perencanaan</option>
                            <option value="PD04" {{ old(
                            'kode_jabatan') == 'PD04' ? 'selected' : '' }}>Kaur Keuangan</option>
                            <option value="PD06" {{ old(
                            'kode_jabatan') == 'PD06' ? 'selected' : '' }}>Kasi Pemerintahan</option>
                            <option value="PD78" {{ old(
                            'kode_jabatan') == 'PD78' ? 'selected' : '' }}>Kasi Kesejahteraan dan Pelayanan</option>
                            <option value="PD09" {{ old(
                            'kode_jabatan') == 'PD09' ? 'selected' : '' }}>Kepala Dusun</option>
                        </select>
                    </div>

                    <!-- Status Jabatan -->
                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-700">Status Jabatan</label>
                        <select name="status_jabatan"
                                class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3 transition-all">
                            <option value="Definitif" {{ old(
                            'status_jabatan') == 'Definitif' ? 'selected' : '' }}>Definitif</option>
                            <option value="Pelaksana Tugas" {{ old(
                            'status_jabatan') == 'Pelaksana Tugas' ? 'selected' : '' }}>Pelaksana Tugas</option>
                            <option value="Pelaksana Harian" {{ old(
                            'status_jabatan') == 'Pelaksana Harian' ? 'selected' : '' }}>Pelaksana Harian</option>
                        </select>
                    </div>

                    <!-- Status Keaktifan -->
                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-700">Status Keaktifan</label>
                        <select name="status_keaktifan"
                                class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3 transition-all">
                            <option value="Aktif" {{ old(
                            'status_keaktifan') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old(
                            'status_keaktifan') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            <option value="Berhenti" {{ old(
                            'status_keaktifan') == 'Berhenti' ? 'selected' : '' }}>Berhenti</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- GARIS PEMISAH & TOMBOL SIMPAN -->
            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                <button type="reset"
                        class="px-6 py-3 text-sm font-bold text-gray-600 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-xl transition-all">
                    Reset Form
                </button>
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl shadow-md transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 11.917 9.724 16.5 19 7.5"/>
                    </svg>
                    Simpan Data Perangkat
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
