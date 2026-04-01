@extends('guest.app')

@section('content')

<div class="p-4 md:p-8">

    {{-- 🔷 STATISTIK IDM (Angka diisi contoh dari controller, misal: $countMandiri) --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-green-100 p-4 rounded-xl text-center shadow">
            <p class="text-sm">Mandiri</p>
            <h2 class="text-2xl font-bold text-green-700">{{ $countMandiri ?? 0 }}</h2>
        </div>
        <div class="bg-blue-100 p-4 rounded-xl text-center shadow">
            <p class="text-sm">Maju</p>
            <h2 class="text-2xl font-bold text-blue-700">{{ $countMaju ?? 0 }}</h2>
        </div>
        <div class="bg-yellow-100 p-4 rounded-xl text-center shadow">
            <p class="text-sm">Berkembang</p>
            <h2 class="text-2xl font-bold text-yellow-700">{{ $countBerkembang ?? 0 }}</h2>
        </div>
        <div class="bg-orange-100 p-4 rounded-xl text-center shadow">
            <p class="text-sm">Tertinggal</p>
            <h2 class="text-2xl font-bold text-orange-700">{{ $countTertinggal ?? 0 }}</h2>
        </div>
        <div class="bg-red-100 p-4 rounded-xl text-center shadow">
            <p class="text-sm">Sangat Tertinggal</p>
            <h2 class="text-2xl font-bold text-red-700">{{ $countSangatTertinggal ?? 0 }}</h2>
        </div>
    </div>

    {{-- 🔷 FILTER + SEARCH (Digabung jadi SATU FORM agar input tidak saling tertimpa) --}}
    <div class="mb-4">
        <form method="GET" class="flex flex-col md:flex-row gap-3 justify-between">

            {{-- FILTER KECAMATAN --}}
            <select name="kecamatan" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-300 text-sm rounded-lg p-2.5 w-full md:w-auto">
                <option value="">Semua Kecamatan</option>
                @foreach($kecamatans as $kecamatan)
                <option value="{{ $kecamatan->kode_kecamatan }}"
                        {{ request(
                'kecamatan') == $kecamatan->kode_kecamatan ? 'selected' : '' }}>
                {{ $kecamatan->nama }}
                </option>
                @endforeach
            </select>

            {{-- SEARCH --}}
            <div class="flex gap-2 w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari desa..."
                       class="bg-gray-50 border border-gray-300 text-sm rounded-lg p-2.5 w-full">
                <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 px-4 rounded-lg shrink-0">
                    Cari
                </button>
            </div>

        </form>
    </div>

    {{-- 🔷 TABEL --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th class="px-4 py-3 text-center">No</th>
                <th class="px-6 py-3 text-center">Nama Desa</th>
                <th class="px-6 py-3 text-center">Kepala Desa</th>
                <th class="px-6 py-3 text-center">Status IDM</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($desas as $index => $desa)
            <tr class="bg-white border-b hover:bg-gray-50">

                <td class="px-4 py-3 text-center">
                    {{ $desas->firstItem() + $index }}
                </td>

                <td class="px-6 py-4 text-center">
                    {{ $desa->nama }}
                </td>

                <td class="px-6 py-4 text-center">
                    {{ $desa->kepalaDesa->nama ?? '-' }}
                </td>

                {{-- BADGE IDM DENGAN NULL-SAFE --}}
                <td class="px-6 py-4 text-center">
                    @php
                    // Ambil status, jika null beri string default.
                    // Tambahkan ->value jika Anda menggunakan PHP Enum di model.
                    $statusRaw = $desa->indeksDesa?->status_desa;
                    $statusText = is_object($statusRaw) ? $statusRaw->value : ($statusRaw ?? 'Belum Dinilai');
                    $statusLower = strtolower($statusText);
                    @endphp

                    <span class="text-xs px-2 py-1 rounded
                        @if($statusLower == 'mandiri') bg-green-200 text-green-800
                        @elseif($statusLower == 'maju') bg-blue-200 text-blue-800
                        @elseif($statusLower == 'berkembang') bg-yellow-200 text-yellow-800
                        @elseif($statusLower == 'tertinggal') bg-orange-200 text-orange-800
                        @elseif($statusLower == 'sangat tertinggal') bg-red-200 text-red-800
                        @else bg-gray-200 text-gray-800
                        @endif
                    ">
                        {{ ucwords($statusText) }}
                    </span>
                </td>

                <td class="px-4 py-3 text-center">
                    <a href="{{ route('desa.detail', $desa->id) }}"
                       class="text-blue-600 hover:underline">
                        Lihat
                    </a>
                </td>

            </tr>
            @endforeach
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="p-4">
            {{ $desas->links() }}
        </div>
    </div>

</div>

@endsection
