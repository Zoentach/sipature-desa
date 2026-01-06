@extends('admin.dashboard')

@section('title', 'Tambah Perjalanan Dinas')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Tambah Perjalanan Dinas
        </h1>
        <p class="text-sm text-gray-600">
            Form input perjalanan dinas beserta pegawai yang mengikuti
        </p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">

            {{-- Alert Success --}}
            @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50">
                {{ session('success') }}
            </div>
            @endif

            {{-- Alert Error --}}
            @if($errors->any())
            <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50">
                <ul class="list-disc ml-4">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('perjalanan-dinas.store') }}" method="POST">
                @csrf

                {{-- Jenis Perjalanan & Nomor SPT --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Jenis Perjalanan
                        </label>
                        <select name="jenis_perjalanan_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Pilih Jenis</option>
                            @foreach($jenisPerjalanan as $jenis)
                            <option value="{{ $jenis->id }}"
                                    {{ old(
                            'jenis_perjalanan_id') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Nomor SPT
                        </label>
                        <input type="text" name="nomor_spt" required
                               value="{{ old('nomor_spt') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               placeholder="090/SPT/I/2026">
                    </div>

                </div>

                {{-- Maksud & Tujuan --}}
                <div class="mt-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Maksud dan Tujuan
                    </label>
                    <textarea name="maksud_tujuan" rows="4" required
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                              placeholder="Contoh: Koordinasi dan konsultasi terkait program kerja...">{{ old('maksud_tujuan') }}</textarea>
                </div>

                {{-- Tanggal & Lama Hari --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Tanggal Berangkat
                        </label>
                        <input type="date" name="tanggal_berangkat" required
                               value="{{ old('tanggal_berangkat') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Tanggal Kembali
                        </label>
                        <input type="date" name="tanggal_kembali" required
                               value="{{ old('tanggal_kembali') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Lama Hari
                        </label>
                        <input type="number" name="lama_hari" min="1" required
                               value="{{ old('lama_hari') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>

                </div>

                {{-- Pegawai --}}
                <div class="mt-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Pegawai yang Mengikuti
                    </label>

                    <select id="pegawaiSelect"
                            name="pegawai_ids[]"
                            multiple
                            required
                            class="hidden">
                        @foreach($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}"
                                {{ collect(old(
                        'pegawai_ids'))->contains($pegawai->id) ? 'selected' : '' }}>
                        {{ $pegawai->nama }} ({{ $pegawai->nip }})
                        </option>
                        @endforeach
                    </select>

                    <p class="mt-1 text-xs text-gray-500">
                        Ketik nama atau NIP untuk mencari pegawai
                    </p>
                </div>

                {{-- Action --}}
                <div class="flex justify-end gap-3 mt-8">
                    <a href="{{ route('perjalanan-dinas.index') }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100
                               rounded-lg hover:bg-gray-200">
                        Batal
                    </a>

                    <button type="submit"
                            class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600
                               rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                        Simpan Perjalanan Dinas
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect("#pegawaiSelect", {
        plugins: ['remove_button'],
        placeholder: 'Pilih pegawai...',
        persist: false,
        create: false,
        maxItems: null
    });
</script>
@endpush
