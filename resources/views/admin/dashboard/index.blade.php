@extends('admin.dashboard')

@section('title', 'Dasbor - Sipature Desa')

@section('content')

<!-- 1. AREA SAMBUTAN & TOMBOL CEPAT -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-extrabold text-emerald-900 tracking-tight">
            Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }} 👋
        </h2>
        <p class="text-gray-500 text-sm mt-1 font-medium">
            Ringkasan data hari ini — {{ now()->translatedFormat('l, d F Y') }}
        </p>
    </div>
    <div class="flex space-x-3">
        <!-- Tombol Aksi Cepat -->
        <button
            class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-xl shadow-md transition-all hover:-translate-y-0.5 flex items-center text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Pengumuman
        </button>
        <button
            class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold py-2 px-4 rounded-xl shadow-sm border border-emerald-200 transition-all text-sm flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
            </svg>
            Unggah Dokumen
        </button>
    </div>
</div>

<!-- 2. KARTU STATISTIK UTAMA (TOP METRICS) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- Card 1: Total Desa -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Total Desa</p>
            <p class="text-2xl font-bold text-emerald-900">211</p>
        </div>
    </div>

    <!-- Card 2: BUMDes Aktif -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">BUMDes Aktif</p>
            <p class="text-2xl font-bold text-emerald-900">45 <span class="text-sm font-normal text-green-500 ml-1">+2 thn ini</span>
            </p>
        </div>
    </div>

    <!-- Card 3: Regulasi Terpublikasi -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Dokumen Publik</p>
            <p class="text-2xl font-bold text-emerald-900">128</p>
        </div>
    </div>

    <!-- Card 4: Absensi Pegawai Hari Ini -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center">
        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Pegawai Hadir</p>
            <p class="text-2xl font-bold text-emerald-900">32<span
                    class="text-base text-gray-400 font-normal">/35</span></p>
        </div>
    </div>
</div>

<!-- 3. AREA VISUALISASI DATA (GRAFIK) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    <!-- Grafik Kiri (Besar) -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:col-span-2">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-emerald-900">Status Indeks Desa Membangun (IDM)</h3>
            <button class="text-sm text-amber-500 font-semibold hover:underline">Lihat Detail</button>
        </div>
        <!-- Placeholder Grafik Batang -->
        <div
            class="w-full h-64 bg-gray-50 rounded-xl border border-gray-100 flex items-end justify-around p-4 relative">
            <span
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-gray-400 font-medium">Area Chart.js (Grafik Batang)</span>
            <!-- Ilustrasi Batang -->
            <div class="w-1/4 bg-emerald-200 rounded-t-md h-1/4 opacity-50"></div>
            <div class="w-1/4 bg-emerald-400 rounded-t-md h-1/2 opacity-50"></div>
            <div class="w-1/4 bg-emerald-600 rounded-t-md h-3/4 opacity-50"></div>
        </div>
    </div>

    <!-- Grafik Kanan (Kecil) -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:col-span-1">
        <h3 class="font-bold text-emerald-900 mb-4">Serapan Anggaran Desa</h3>
        <!-- Placeholder Donut Chart -->
        <div class="w-full h-64 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-center relative">
            <span class="absolute text-gray-400 font-medium text-sm text-center">Chart.js<br>(Donut Chart)</span>
            <div
                class="w-32 h-32 rounded-full border-8 border-amber-400 border-r-emerald-100 border-t-emerald-100 opacity-50"></div>
        </div>
    </div>
</div>

<!-- 4. AREA TABEL DINAMIS (BAWAH) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Tabel Regulasi Terbaru -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-emerald-900">Regulasi & Dokumen Terbaru</h3>
            <a href="{{ route('regulasi.index') }}" class="text-sm text-emerald-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 rounded-lg">
                <tr>
                    <th class="px-4 py-3 rounded-l-lg">Judul Dokumen</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3 rounded-r-lg text-center">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b border-gray-50 hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900 truncate max-w-[150px]">Perbup Alokasi Dana Desa
                        2026
                    </td>
                    <td class="px-4 py-3">12 Ags 2026</td>
                    <td class="px-4 py-3 text-center"><span
                            class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Publik</span>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900 truncate max-w-[150px]">Laporan Realisasi Semester
                        1
                    </td>
                    <td class="px-4 py-3">05 Ags 2026</td>
                    <td class="px-4 py-3 text-center"><span
                            class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Publik</span>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900 truncate max-w-[150px]">SK Tim PTP2WKSS</td>
                    <td class="px-4 py-3">01 Ags 2026</td>
                    <td class="px-4 py-3 text-center"><span
                            class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded">Internal</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Tugas Luar / Aktivitas -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-emerald-900">Pegawai Tugas Luar (TL) Hari Ini</h3>
            <a href="{{ route('perjalanan-dinas.index') }}" class="text-sm text-emerald-600 hover:underline">Selengkapnya</a>
        </div>
        <ul class="divide-y divide-gray-100">
            <li class="py-3 flex items-center justify-between">
                <div class="flex items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold mr-3">
                        AR
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Ahmad Rasyid</p>
                        <p class="text-xs text-gray-500">Monitoring BUMDes Sipirok</p>
                    </div>
                </div>
                <span class="text-xs font-medium text-amber-500 bg-amber-50 px-2 py-1 rounded">Kembali Besok</span>
            </li>
            <li class="py-3 flex items-center justify-between">
                <div class="flex items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold mr-3">
                        SN
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Siti Nurbaya</p>
                        <p class="text-xs text-gray-500">Rapat Koordinasi Pemprov</p>
                    </div>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded">Selesai 16:00</span>
            </li>
            <li class="py-3 flex text-center justify-center items-center">
                <p class="text-sm text-gray-400 italic mt-2">Tidak ada data pegawai TL lainnya.</p>
            </li>
        </ul>
    </div>

</div>

@endsection
