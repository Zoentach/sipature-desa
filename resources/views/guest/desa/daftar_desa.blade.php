@extends('guest.app')

@section('content')

<div class="p-4 md:p-8">

    {{-- 🔷 HEADER --}}
    <div class="mb-6 text-center md:text-left">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
            Desa di Tapanuli Selatan
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            Data desa berdasarkan status Indeks Desa Membangun (IDM)
        </p>
    </div>

    {{-- 🔷 STATISTIK --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">

        <div
            class="bg-gradient-to-r from-green-400 to-green-600 text-white p-4 rounded-xl text-center shadow hover:scale-105 transition">
            <p class="text-sm">Mandiri</p>
            <h2 class="text-2xl font-bold">{{ $countMandiri ?? 0 }}</h2>
        </div>

        <div
            class="bg-gradient-to-r from-blue-400 to-blue-600 text-white p-4 rounded-xl text-center shadow hover:scale-105 transition">
            <p class="text-sm">Maju</p>
            <h2 class="text-2xl font-bold">{{ $countMaju ?? 0 }}</h2>
        </div>

        <div
            class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white p-4 rounded-xl text-center shadow hover:scale-105 transition">
            <p class="text-sm">Berkembang</p>
            <h2 class="text-2xl font-bold">{{ $countBerkembang ?? 0 }}</h2>
        </div>

        <div
            class="bg-gradient-to-r from-orange-400 to-orange-600 text-white p-4 rounded-xl text-center shadow hover:scale-105 transition">
            <p class="text-sm">Tertinggal</p>
            <h2 class="text-2xl font-bold">{{ $countTertinggal ?? 0 }}</h2>
        </div>

        <div
            class="bg-gradient-to-r from-red-400 to-red-600 text-white p-4 rounded-xl text-center shadow hover:scale-105 transition">
            <p class="text-sm">Sangat Tertinggal</p>
            <h2 class="text-2xl font-bold">{{ $countSangatTertinggal ?? 0 }}</h2>
        </div>

    </div>

    {{-- 🔷 FILTER + SEARCH --}}
    <div class="mb-4 bg-white p-4 rounded-xl shadow flex flex-col md:flex-row gap-3 justify-between items-center">

        <form method="GET" class="flex flex-col md:flex-row gap-3 w-full">

            {{-- FILTER --}}
            <select name="kecamatan" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-300 text-sm rounded-lg p-2.5 w-full md:w-60">
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
            <div class="flex gap-2 w-full">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama desa..."
                       class="bg-gray-50 border border-gray-300 text-sm rounded-lg p-2.5 w-full focus:ring focus:ring-blue-200">

                <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 px-4 rounded-lg">
                    Cari
                </button>
            </div>

        </form>
    </div>

    {{-- 🔷 TABEL --}}
    <div class="relative overflow-x-auto shadow-lg rounded-xl">

        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
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
            <tr class="bg-white border-b hover:bg-blue-50 transition">

                <td class="px-4 py-3 text-center">
                    {{ $desas->firstItem() + $index }}
                </td>

                <td class="px-6 py-4 text-center font-medium text-gray-800">
                    {{ $desa->nama }}
                </td>

                <td class="px-6 py-4 text-center">
                    {{ $desa->kepalaDesa->nama ?? '-' }}
                </td>

                {{-- STATUS --}}
                <td class="px-6 py-4 text-center">
                    @php
                    $statusRaw = $desa->indeksDesa?->status_desa;
                    $statusText = is_object($statusRaw) ? $statusRaw->value : ($statusRaw ?? 'Belum Dinilai');
                    $statusLower = strtolower($statusText);
                    @endphp

                    <span class="text-xs px-3 py-1 rounded-full font-semibold
                            @if($statusLower == 'mandiri') bg-green-200 text-green-800
                            @elseif($statusLower == 'maju') bg-blue-200 text-blue-800
                            @elseif($statusLower == 'berkembang') bg-yellow-200 text-yellow-800
                            @elseif($statusLower == 'tertinggal') bg-orange-200 text-orange-800
                            @elseif($statusLower == 'sangat tertinggal') bg-red-200 text-red-800
                            @else bg-gray-200 text-gray-800
                            @endif">
                            {{ ucwords($statusText) }}
                        </span>
                </td>

                <td class="px-4 py-3 text-center">
                    <a href="{{ route('desa.detail', $desa->id) }}"
                       class="inline-block bg-blue-600 text-white px-3 py-1 rounded-lg text-xs hover:bg-blue-700 transition">
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
