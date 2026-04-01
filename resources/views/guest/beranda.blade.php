@extends('guest.app')

@section('title', 'Beranda')

@section('content')

<!-- HERO SECTION -->
<section class="relative bg-gradient-to-r from-blue-900 to-blue-700 text-white py-24">

    <div class="max-w-screen-xl mx-auto px-6 text-center">

        <h1 class="text-2xl md:text-4xl font-bold leading-relaxed mb-6">
            Dinas Pemberdayaan Masyarakat dan Desa <br>
            Kabupaten Tapanuli Selatan
        </h1>

        <p class="mb-8 text-lg">
            Mewujudkan Desa Mandiri, Sejahtera, dan Berdaya Saing
        </p>

        <!-- SEARCH -->
        <div class="max-w-xl mx-auto">
            <div class="relative">
                <input type="search"
                       class="w-full p-4 rounded-lg text-gray-900 focus:ring-2 focus:ring-blue-400 shadow"
                       placeholder="Cari data desa...">

                <button class="absolute right-2 top-2 bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    🔍
                </button>
            </div>
        </div>
    </div>

    <!-- WAVE -->
    <div class="absolute bottom-0 left-0 w-full h-24 bg-white rounded-t-[60px]"></div>
</section>


<!-- STATISTIK CARD -->
<section class="relative -mt-10 pb-12">

    <div class="max-w-screen-xl mx-auto px-6">

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">

            <a href="{{ route('desa.daftar') }} ">
                <div
                    class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg hover:scale-105 transition cursor-pointer">

                    <!-- ICON -->
                    <div class="flex justify-center mb-3">
                        <img src="{{ asset('images/ikon_desa.png') }}" class="h-10" alt="Icon Desa">
                    </div>

                    <!-- TITLE -->
                    <h3 class="text-center font-semibold text-sm mb-2">Jumlah Desa</h3>

                    <!-- TOTAL -->
                    <p class="text-center text-2xl font-bold text-blue-700 mb-3">211</p>

                    <!-- ACTION -->
                    <p class="text-center text-sm text-blue-600 font-medium hover:underline">
                        Lihat Detail →
                    </p>

                </div>
            </a>

            <!-- CARD 2 -->
            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                <div class="text-blue-600 text-2xl mb-2">📊</div>
                <h3 class="font-semibold text-sm">Desa Mandiri</h3>
                <p class="text-2xl font-bold mt-2">-</p>
                <span class="text-gray-500 text-sm">Desa</span>
            </div>

            <!-- CARD 3 -->
            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                <div class="text-blue-600 text-2xl mb-2">📈</div>
                <h3 class="font-semibold text-sm">BUMDes Aktif</h3>
                <p class="text-2xl font-bold mt-2">-</p>
                <span class="text-gray-500 text-sm">Unit</span>
            </div>

            <!-- CARD 4
            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                <div class="text-blue-600 text-2xl mb-2">👨‍👩‍👧</div>
                <h3 class="font-semibold text-sm">Penduduk Desa</h3>
                <p class="text-2xl font-bold mt-2">-</p>
                <span class="text-gray-500 text-sm">Jiwa</span>
            </div>
            -->

            <!-- CARD BUKU PANDUAN -->
            <div
                class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition hover:scale-105 cursor-pointer">
                <div class="text-blue-600 text-2xl mb-2">📘</div>
                <h3 class="font-semibold text-sm">Buku Panduan</h3>
                <p class="text-lg font-bold mt-2">-</p>
                <span class="text-gray-500 text-sm">Panduan Desa</span>
            </div>

            <!-- CARD 5 -->
            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                <div class="text-blue-600 text-2xl mb-2">💼</div>
                <h3 class="font-semibold text-sm">Program Aktif</h3>
                <p class="text-2xl font-bold mt-2">15</p>
                <span class="text-gray-500 text-sm">Program</span>
            </div>

            <!-- CARD 6 (BARU) -->
            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition">
                <div class="text-blue-600 text-2xl mb-2">📜</div>
                <h3 class="font-semibold text-sm">Regulasi</h3>
                <p class="text-lg font-bold mt-2">12</p>
                <span class="text-gray-500 text-xs">Terkait Desa</span>
            </div>

        </div>
    </div>
</section>

@endsection
