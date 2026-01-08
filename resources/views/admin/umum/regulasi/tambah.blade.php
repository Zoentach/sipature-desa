@extends('admin.dashboard')

@section('title', 'Tambah Perjalanan Dinas')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Tambah Regulasi / Produk Hukum
        </h1>
        <p class="text-sm text-gray-500">
            Lengkapi data regulasi dan unggah dokumen resmi
        </p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-lg shadow p-6">

        <form action="{{ route('regulasi.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            {{-- Jenis Regulasi --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Jenis Regulasi
                </label>
                <select name="jenis_regulasi_id"
                        required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">-- Pilih Jenis Regulasi --</option>
                    @foreach ($jenisRegulasi as $jenis)
                    <option value="{{ $jenis->id }}"
                            {{ old(
                    'jenis_regulasi_id') == $jenis->id ? 'selected' : '' }}>
                    {{ $jenis->nama_regulasi }}
                    </option>
                    @endforeach
                </select>

                @error('jenis_regulasi_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor & Tahun --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Nomor Regulasi
                    </label>
                    <input type="text"
                           name="nomor_regulasi"
                           value="{{ old('nomor_regulasi') }}"
                           required
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="Contoh: 12">

                    @error('nomor_regulasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Tahun
                    </label>
                    <input type="number"
                           name="tahun"
                           value="{{ old('tahun') }}"
                           required
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                           placeholder="2026">

                    @error('tahun')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tentang --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Tentang
                </label>
                <textarea name="tentang"
                          rows="3"
                          required
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                          placeholder="Ringkasan isi regulasi">{{ old('tentang') }}</textarea>

                @error('tentang')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Unit Kerja --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Unit Kerja Terkait
                </label>
                <select name="unit_kerja_id"
                        required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">-- Pilih Unit Kerja --</option>
                    @foreach ($unitKerja as $unit)
                    <option value="{{ $unit->id }}"
                            {{ old(
                    'unit_kerja_id') == $unit->id ? 'selected' : '' }}>
                    {{ $unit->nama_unit }}
                    </option>
                    @endforeach
                </select>

                @error('unit_kerja_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Upload Dokumen --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Dokumen Regulasi (PDF)
                </label>
                <input type="file"
                       name="file_dokumen"
                       accept="application/pdf"
                       required
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg
                              cursor-pointer bg-gray-50">

                <p class="mt-1 text-sm text-gray-500">
                    Format PDF, maksimal 10MB
                </p>

                @error('file_dokumen')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('regulasi.index') }}"
                   class="text-gray-700 bg-white border border-gray-300
                          hover:bg-gray-100 rounded-lg text-sm px-5 py-2.5">
                    Batal
                </a>

                <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700
                               rounded-lg text-sm px-5 py-2.5">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>


@endsection

