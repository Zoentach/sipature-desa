@extends('guest.layouts.app') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
<div
    class="max-w-4xl mx-auto my-8 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Perjalanan Dinas</h2>
        <a href="{{ route('perjalanan-dinas.index') }}"
           class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Kembali
        </a>
    </div>

    <form action="{{ route('perjalanan-dinas.update', $perjalanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Grid Layout --}}
        <div class="grid gap-6 mb-6 md:grid-cols-2">

            {{-- Nomor SPT --}}
            <div>
                <label for="nomor_spt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                    SPT</label>
                <input type="text" id="nomor_spt" name="nomor_spt"
                       value="{{ old('nomor_spt', $perjalanan->nomor_spt) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       required>
                @error('nomor_spt') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Jenis Perjalanan --}}
            <div>
                <label for="jenis_perjalanan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                    Perjalanan</label>
                <select id="jenis_perjalanan_id" name="jenis_perjalanan_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                    <option value="">Pilih Jenis</option>
                    @foreach($jenisPerjalanan as $jenis)
                    <option value="{{ $jenis->id }}"
                            {{ old(
                    'jenis_perjalanan_id', $perjalanan->jenis_perjalanan_id) == $jenis->id ? 'selected' : '' }}>
                    {{ $jenis->nama_jenis ?? $jenis->nama }} {{-- Sesuaikan kolom nama di tabel jenis --}}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal Berangkat --}}
            <div>
                <label for="tanggal_berangkat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                    Berangkat</label>
                <input type="date" id="tanggal_berangkat" name="tanggal_berangkat"
                       value="{{ old('tanggal_berangkat', $perjalanan->tanggal_berangkat) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       required>
            </div>

            {{-- Tanggal Kembali --}}
            <div>
                <label for="tanggal_kembali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                    Kembali</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali"
                       value="{{ old('tanggal_kembali', $perjalanan->tanggal_kembali) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       required>
            </div>

            {{-- Lama Hari (Readonly / Calculated) --}}
            <div>
                <label for="lama_hari" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lama
                    Hari</label>
                <input type="number" id="lama_hari" name="lama_hari"
                       value="{{ old('lama_hari', $perjalanan->lama_hari) }}"
                       class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                       readonly required>
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="status" name="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach(['draft', 'disetujui', 'selesai'] as $st)
                    <option value="{{ $st }}" {{ old(
                    'status', $perjalanan->status) == $st ? 'selected' : '' }}>
                    {{ ucfirst($st) }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Maksud Tujuan --}}
        <div class="mb-6">
            <label for="maksud_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Maksud &
                Tujuan</label>
            <textarea id="maksud_tujuan" name="maksud_tujuan" rows="3"
                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                      required>{{ old('maksud_tujuan', $perjalanan->maksud_tujuan) }}</textarea>
        </div>

        {{-- Pilihan Pegawai (Multiple Select) --}}
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Pegawai (Bisa lebih dari
                satu)</label>
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 border p-4 rounded-lg bg-gray-50 max-h-60 overflow-y-auto">
                @foreach($pegawais as $pegawai)
                <div class="flex items-center">
                    <input id="pegawai_{{ $pegawai->id }}" type="checkbox" name="pegawai_ids[]"
                           value="{{ $pegawai->id }}"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                           {{-- Logic Checkbox: Cek apakah ID pegawai ada di koleksi relasi perjalanan --}}
                           {{ (collect(old('pegawai_ids', $perjalanan->pegawais->pluck('id')))->contains($pegawai->id))
                    ? 'checked' : '' }}>
                    <label for="pegawai_{{ $pegawai->id }}"
                           class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        {{ $pegawai->nama }}
                    </label>
                </div>
                @endforeach
            </div>
            @error('pegawai_ids') <span class="text-red-500 text-xs">Minimal satu pegawai harus dipilih</span> @enderror
        </div>

        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
            Simpan Perubahan
        </button>
    </form>
</div>

<script>
    // Script Sederhana Hitung Hari
    document.addEventListener('DOMContentLoaded', function () {
        const tglBerangkat = document.getElementById('tanggal_berangkat');
        const tglKembali = document.getElementById('tanggal_kembali');
        const lamaHari = document.getElementById('lama_hari');

        function hitungHari() {
            if (tglBerangkat.value && tglKembali.value) {
                const start = new Date(tglBerangkat.value);
                const end = new Date(tglKembali.value);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // +1 karena inklusif

                if (!isNaN(diffDays) && diffDays > 0) {
                    lamaHari.value = diffDays;
                } else {
                    lamaHari.value = 0;
                }
            }
        }

        tglBerangkat.addEventListener('change', hitungHari);
        tglKembali.addEventListener('change', hitungHari);
    });
</script>
@endsection
