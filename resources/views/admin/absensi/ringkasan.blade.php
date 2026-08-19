@extends('admin.dashboard')

@section('content')
<!-- Tidak perlu container-fluid lagi, file layout induk sudah mengaturnya -->
<div class="w-full min-h-screen pb-10">

    <!-- HEADER PREMIUM (TEMA EMERALD GRADIENT) -->
    <div
        class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 p-6 md:p-8 shadow-lg relative overflow-hidden bg-gradient-to-br from-emerald-800 via-emerald-700 to-green-700 rounded-2xl border border-emerald-600">

        <!-- Elemen Dekoratif di Background (Lingkaran Transparan) -->
        <div class="absolute -right-10 -top-24 w-64 h-64 bg-white/10 rounded-full pointer-events-none blur-2xl"></div>
        <div class="absolute right-1/4 -bottom-20 w-40 h-40 bg-white/10 rounded-full pointer-events-none blur-xl"></div>

        <!-- Bagian Kiri: Judul & Subjudul -->
        <div class="flex items-center relative z-10 text-white mb-6 md:mb-0">
            <!-- Ikon Dashboard -->
            <div class="mr-4 p-4 rounded-full flex items-center justify-center shadow-inner border border-white/20"
                 style="background: rgba(255,255,255,0.15); backdrop-filter: blur(8px);">
                <i class="fas fa-chart-pie text-2xl text-white"></i>
            </div>
            <div>
                <h3 class="text-2xl md:text-3xl font-extrabold tracking-tight drop-shadow-md mb-1">
                    Dashboard Ringkasan
                </h3>
                <p class="text-emerald-50 text-sm font-medium opacity-90">
                    Struktur Organisasi & Analisis Kehadiran
                </p>
            </div>
        </div>

        <!-- Bagian Kanan: Total Aparatur (Aksen Kuning Emas) -->
        <div
            class="bg-white px-6 py-4 shadow-xl relative z-10 flex items-center rounded-xl border-l-4 border-amber-500 transition-transform hover:scale-105">
            <div class="mr-4 hidden sm:block p-3 rounded-lg bg-emerald-50 text-emerald-700">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">
                    Total Aparatur Aktif
                </div>
                <div class="flex items-baseline text-emerald-950">
                    <span class="text-4xl font-black leading-none">{{ $totalSemuaAparatur }}</span>
                    <span class="ml-1 text-sm font-bold text-gray-500">Orang</span>
                </div>
            </div>
        </div>
    </div>

    <!-- BAGAN STRUKTUR (CSS Grid Layout - Tema Emerald) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6 overflow-hidden">
        <div class="p-6 overflow-x-auto">

            <!-- Wrapper Grid -->
            <div class="org-grid-container pb-4">

                <!-- LEVEL 1: KADES -->
                <div class="org-card box-kades item-kades">
                    <div class="title text-amber-300">KEPALA DESA</div>
                    <div class="count">{{ $counts['kades'] }} Orang</div>
                </div>

                <!-- LEVEL 2: SEKDES -->
                <div class="org-card box-sekdes item-sekdes">
                    <div class="title text-amber-200">SEKRETARIS DESA</div>
                    <div class="count">{{ $counts['sekdes'] }} Orang</div>
                </div>

                <!-- LEVEL 3: KASI & KAUR -->
                <div class="org-card box-kasi item-kasi-1">
                    <div class="title">KASI PEMERINTAHAN</div>
                    <div class="count">{{ $counts['kasi_pemerintahan'] }} Orang</div>
                </div>

                <div class="org-card box-kasi item-kasi-2">
                    <div class="title">KASI KESEJAHTERAAN & PELAYANAN</div>
                    <div class="count">{{ $counts['kasi_kesejahteraan'] }} Orang</div>
                </div>

                <div class="org-card box-kaur item-kaur-1">
                    <div class="title">KAUR UMUM & PERENCANAAN</div>
                    <div class="count">{{ $counts['kaur_umum'] }} Orang</div>
                </div>

                <div class="org-card box-kaur item-kaur-2">
                    <div class="title">KAUR KEUANGAN</div>
                    <div class="count">{{ $counts['kaur_keuangan'] }} Orang</div>
                </div>

                <!-- LEVEL 4: KADUS -->
                <div class="org-card box-kadus item-kadus border border-gray-200">
                    <div class="title">KEPALA DUSUN</div>
                    <div class="count">{{ $counts['kadus'] }} Orang</div>
                </div>

            </div>
        </div>
    </div>

    <!-- GRAFIK KEHADIRAN -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <!-- Header Grafik -->
        <div class="flex flex-col sm:flex-row justify-between items-center p-6 border-b border-gray-50 gap-4">
            <h6 class="text-lg font-bold text-emerald-900 m-0 flex items-center">
                <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                </svg>
                Grafik Persentase Kehadiran
            </h6>

            <!-- Filter Periode (Tailwind Style) -->
            <form method="GET" action="{{ route('absensi.ringkasan') }}"
                  class="flex items-center bg-gray-50 rounded-xl px-4 py-2 border border-gray-200 shadow-sm">
                <span class="text-gray-500 text-sm font-bold mr-3">Periode:</span>
                <select name="bulan"
                        class="bg-transparent border-0 text-emerald-800 font-bold text-sm focus:ring-0 cursor-pointer p-0"
                        onchange="this.form.submit()">
                    @for($m=1; $m<=12; $m++)
                    <option value="{{ $m }}" {{ $bulan== $m ?
                    'selected' : '' }}>
                    {{ Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                    </option>
                    @endfor
                </select>
                <div class="w-px h-5 bg-gray-300 mx-3"></div>
                <select name="tahun"
                        class="bg-transparent border-0 text-emerald-800 font-bold text-sm focus:ring-0 cursor-pointer p-0"
                        onchange="this.form.submit()">
                    @for($y=date('Y'); $y>=date('Y')-2; $y--)
                    <option value="{{ $y }}" {{ $tahun== $y ?
                    'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </form>
        </div>

        <!-- Canvas Area -->
        <div class="p-6">
            <div class="w-full" style="height: 350px;">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- CSS KHUSUS TATA LETAK GRID -->
<style>
    .org-grid-container {
        display: grid;
        grid-template-columns: repeat(4, minmax(200px, 1fr));
        gap: 20px;
        justify-content: center;
        min-width: 900px; /* Minimal width agar tidak hancur */
        margin: 0 auto;
    }

    .item-kades {
        grid-column: 1 / span 4;
        justify-self: center;
        width: 300px;
        margin-bottom: 15px;
    }

    .item-sekdes {
        grid-column: 3 / span 2;
        justify-self: center;
        width: 280px;
        margin-bottom: 10px;
    }

    .item-kasi-1 {
        grid-column: 1;
    }

    .item-kasi-2 {
        grid-column: 2;
    }

    .item-kaur-1 {
        grid-column: 3;
    }

    .item-kaur-2 {
        grid-column: 4;
    }

    .item-kadus {
        grid-column: 1 / span 4;
        justify-self: center;
        width: 100%;
        margin-top: 25px;
    }

    /* Styling Visual Kotak Kartu Tema Emerald */
    .org-card {
        padding: 16px 12px;
        border-radius: 12px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    .org-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .org-card .title {
        font-size: 11px;
        font-weight: 800;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        line-height: 1.4;
        opacity: 0.9;
    }

    .org-card .count {
        font-size: 18px;
        font-weight: 800;
    }

    /* Palet Warna */
    .box-kades {
        background-color: #064e3b;
        color: #ffffff;
    }

    /* emerald-900 */
    .box-sekdes {
        background-color: #047857;
        color: #ffffff;
    }

    /* emerald-700 */
    .box-kasi {
        background-color: #059669;
        color: #ffffff;
    }

    /* emerald-600 */
    .box-kaur {
        background-color: #10b981;
        color: #ffffff;
    }

    /* emerald-500 */
    .box-kadus {
        background-color: #f8fafc;
        color: #064e3b;
    }

    /* slate-50 text emerald-900 */
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('attendanceChart').getContext('2d');

        // Gradasi Hijau Emerald untuk grafik
        let gradientHadir = ctx.createLinearGradient(0, 0, 0, 400);
        gradientHadir.addColorStop(0, '#10b981'); // Emerald 500
        gradientHadir.addColorStop(1, '#047857'); // Emerald 700

        // Gradasi Kuning Emas (Amber) untuk data sekunder (jika diperlukan)
        let gradientAmber = ctx.createLinearGradient(0, 0, 0, 400);
        gradientAmber.addColorStop(0, '#f59e0b'); // Amber 500
        gradientAmber.addColorStop(1, '#d97706'); // Amber 600

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json(array_keys($chartPercentages)),
                datasets: [{
                    label: 'Persentase Kehadiran (%)',
                    data: @json(array_values($chartPercentages)),
                    backgroundColor: [
                        gradientHadir,
                        gradientAmber,
                        '#3b82f6', // Blue
                        '#f43f5e', // Rose
                        '#8b5cf6', // Violet
                        '#64748b'  // Slate
                    ],
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {display: false},
                    tooltip: {
                        backgroundColor: '#064e3b',
                        padding: 12,
                        titleFont: {size: 13, family: 'sans-serif'},
                        bodyFont: {size: 14, weight: 'bold'}
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {borderDash: [4, 4], color: '#f1f5f9'},
                        ticks: {font: {weight: 'bold'}, color: '#64748b'}
                    },
                    x: {
                        grid: {display: false},
                        ticks: {font: {weight: 'bold'}, color: '#475569'}
                    }
                }
            }
        });
    });
</script>
@endsection
