@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-3xl">

    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Indeks Desa</h2>
        <a href="{{ route('indeks-desa.index') }}"
           class="text-gray-600 hover:text-gray-900 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md border border-gray-100 p-6">
        <form action="{{ route('indeks-desa.update', $indeksDesa->id) }}" method="POST">
            @csrf
            {{-- Method spoofing untuk mengubah POST menjadi PUT sesuai standar update Laravel --}}
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Kode Desa --}}
                <div>
                    <label for="kode_desa" class="block text-sm font-medium text-gray-700 mb-1">Kode Desa</label>
                    <input type="text" name="kode_desa" id="kode_desa"
                           value="{{ old('kode_desa', $indeksDesa->kode_desa) }}" required
                           class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 @error('kode_desa') border-red-500 @enderror">
                    @error('kode_desa')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kode Kecamatan --}}
                <div>
                    <label for="kode_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kode
                        Kecamatan</label>
                    <input type="text" name="kode_kecamatan" id="kode_kecamatan"
                           value="{{ old('kode_kecamatan', $indeksDesa->kode_kecamatan) }}" required
                           class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 @error('kode_kecamatan') border-red-500 @enderror">
                    @error('kode_kecamatan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tahun --}}
                <div>
                    <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                    <input type="number" name="tahun" id="tahun" min="2000" max="{{ date('Y') + 1 }}"
                           value="{{ old('tahun', $indeksDesa->tahun) }}" required
                           class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 @error('tahun') border-red-500 @enderror">
                    @error('tahun')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Desa --}}
                <div>
                    <label for="status_desa" class="block text-sm font-medium text-gray-700 mb-1">Status Desa</label>
                    <select name="status_desa" id="status_desa" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 bg-white @error('status_desa') border-red-500 @enderror">
                        <option value="" disabled>-- Pilih Status --</option>
                        @foreach($statuses as $status)
                        <option value="{{ $status->value }}"
                                {{ old(
                        'status_desa', $indeksDesa->status_desa->value ?? $indeksDesa->status_desa) == $status->value ?
                        'selected' : '' }}>
                        {{ $status->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('status_desa')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Skor IKS --}}
                <div>
                    <label for="skor_iks" class="block text-sm font-medium text-gray-700 mb-1">Skor IKS</label>
                    <input type="number" step="0.0001" name="skor_iks" id="skor_iks"
                           value="{{ old('skor_iks', $indeksDesa->skor_iks) }}" required
                           class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 @error('skor_iks') border-red-500 @enderror">
                    @error('skor_iks')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Skor IKE --}}
                <div>
                    <label for="skor_ike" class="block text-sm font-medium text-gray-700 mb-1">Skor IKE</label>
                    <input type="number" step="0.0001" name="skor_ike" id="skor_ike"
                           value="{{ old('skor_ike', $indeksDesa->skor_ike) }}" required
                           class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 @error('skor_ike') border-red-500 @enderror">
                    @error('skor_ike')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Skor IKL --}}
                <div>
                    <label for="skor_ikl" class="block text-sm font-medium text-gray-700 mb-1">Skor IKL</label>
                    <input type="number" step="0.0001" name="skor_ikl" id="skor_ikl"
                           value="{{ old('skor_ikl', $indeksDesa->skor_ikl) }}" required
                           class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 @error('skor_ikl') border-red-500 @enderror">
                    @error('skor_ikl')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Skor IDM --}}
                <div>
                    <label for="skor_idm" class="block text-sm font-medium text-gray-700 mb-1">Skor IDM</label>
                    <input type="number" step="0.0001" name="skor_idm" id="skor_idm"
                           value="{{ old('skor_idm', $indeksDesa->skor_idm) }}" required
                           class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 @error('skor_idm') border-red-500 @enderror">
                    @error('skor_idm')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-5">
                <a href="{{ route('indeks-desa.index') }}"
                   class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-md font-medium transition">
                    Batal
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
