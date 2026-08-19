@extends('guest.app')

@section('title', 'Beranda')

@section('content')

<!-- CONTAINER UTAMA (Menjaga kesejajaran dengan Navbar) -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- ALERT INFORMASI MENDESAK (Melayang Elegan) -->
    <div
        class="mb-6 bg-white border-l-4 border-amber-500 rounded-r-xl shadow-md p-4 flex items-start space-x-4 animate-fade-in-down"
        role="alert">
        <svg class="h-6 w-6 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <div>
            <h3 class="font-bold text-gray-800 text-sm">Informasi Mendesak</h3>
            <p class="text-sm text-gray-600 mt-1">Pembaruan data desa dan unggahan dokumen layanan publik wajib
                diselesaikan sebelum batas waktu yang ditentukan.</p>
        </div>
    </div>

    <!-- HERO SECTION -->
    <section
        class="relative bg-gradient-to-br from-emerald-800 via-emerald-700 to-green-700 text-white pt-20 pb-28 px-6 md:px-12 rounded-[2rem] shadow-2xl overflow-hidden">

        <!-- Ornamen Latar Belakang -->
        <div
            class="absolute inset-0 bg-white opacity-5 bg-[url('/images/pattern.svg')] bg-cover mix-blend-overlay"></div>

        <div class="relative z-10 text-center max-w-3xl mx-auto">
            <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-6 tracking-tight drop-shadow-md">
                Dinas Pemberdayaan Masyarakat dan Desa <br>
                <span class="text-amber-300">Kabupaten Tapanuli Selatan</span>
            </h1>
            <p class="mb-10 text-lg md:text-xl text-emerald-50 font-light drop-shadow">
                Mewujudkan Desa Mandiri, Sejahtera, dan Berdaya Saing melalui Keterbukaan Informasi.
            </p>

            <!-- SEARCH BAR (Bentuk Pil Modern) -->
            <div class="relative max-w-2xl mx-auto">
                <input type="search"
                       class="w-full p-4 pl-6 rounded-full text-gray-900 border-0 focus:ring-4 focus:ring-amber-400/50 shadow-xl transition-all outline-none"
                       placeholder="Cari data atau nama desa...">

                <button
                    class="absolute right-2 top-2 bottom-2 bg-amber-500 px-6 rounded-full text-white font-bold hover:bg-amber-600 shadow-md transition-colors flex items-center">
                    Cari <span class="ml-2">🔍</span>
                </button>
            </div>
        </div>

        <!-- EFEK LENGKUNGAN BAWAH -->
        <div class="absolute -bottom-2 left-0 w-full h-16 bg-slate-50 rounded-t-[50%] transform scale-x-110"></div>
    </section>

    <!-- STATISTIK CARD -->
    <section class="relative -mt-10 pb-12 z-20">
        <div class="max-w-screen-xl mx-auto px-6">
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">

                <!-- CARD 1: Jumlah Desa -->
                <a href="#" class="block h-full">
                    <div
                        class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg hover:scale-105 transition cursor-pointer border-t-4 border-green-600 h-full flex flex-col justify-between">
                        <div>
                            <div class="flex justify-center mb-3">
                                <img src="{{ asset('images/ikon_desa.png') }}" class="h-10" alt="Icon Desa">
                            </div>
                            <h3 class="text-center font-semibold text-sm mb-2 text-gray-700">Jumlah Desa</h3>
                            <p class="text-center text-2xl font-bold text-green-700 mb-3">211</p>
                        </div>
                        <p class="text-center text-sm text-green-600 font-medium hover:underline">
                            Lihat Detail →
                        </p>
                    </div>
                </a>

                <!-- CARD 2: Desa Mandiri -->
                <a href="#" class="block h-full">
                    <div
                        class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg hover:scale-105 transition cursor-pointer border-t-4 border-green-600 h-full flex flex-col justify-between text-center">
                        <div>
                            <div class="flex justify-center mb-3">
                                <img src="{{ asset('images/ikon_grafik_balok.png') }}" class="h-10"
                                     alt="Icon Desa Mandiri">
                            </div>
                            <h3 class="font-semibold text-sm mb-2 text-gray-700">Desa Mandiri</h3>
                            <p class="text-2xl font-bold text-green-700">-</p>
                        </div>
                        <span class="text-gray-500 text-sm mt-3">Desa</span>
                    </div>
                </a>

                <!-- CARD 3: BUMDes Aktif -->
                <a href="#" class="block h-full">
                    <div
                        class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg hover:scale-105 transition cursor-pointer border-t-4 border-green-600 h-full flex flex-col justify-between text-center">
                        <div>
                            <div class="flex justify-center mb-3">
                                <img src="{{ asset('images/ikon_grafik_garis.png') }}" class="h-10" alt="Icon BUMDes">
                            </div>
                            <h3 class="font-semibold text-sm mb-2 text-gray-700">BUMDes Aktif</h3>
                            <p class="text-2xl font-bold text-green-700">-</p>
                        </div>
                        <span class="text-gray-500 text-sm mt-3">Unit</span>
                    </div>
                </a>

                <!-- CARD 4: Buku Panduan -->
                <a href="#" class="block h-full">
                    <div
                        class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg hover:scale-105 transition cursor-pointer border-t-4 border-yellow-500 h-full flex flex-col justify-between text-center">
                        <div>
                            <div class="flex justify-center mb-3">
                                <img src="{{ asset('images/ikon_buku.png') }}" class="h-10" alt="Icon Buku Panduan">
                            </div>
                            <h3 class="font-semibold text-sm mb-2 text-gray-700">Buku Panduan</h3>
                            <p class="text-lg font-bold text-yellow-600">-</p>
                        </div>
                        <span class="text-gray-500 text-sm mt-3">Panduan Desa</span>
                    </div>
                </a>

                <!-- CARD 5: Program Aktif -->
                <a href="#" class="block h-full">
                    <div
                        class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg hover:scale-105 transition cursor-pointer border-t-4 border-green-600 h-full flex flex-col justify-between text-center">
                        <div>
                            <div class="flex justify-center mb-3">
                                <img src="{{ asset('images/ikon_tas_kerja.png') }}" class="h-10" alt="Icon Program">
                            </div>
                            <h3 class="font-semibold text-sm mb-2 text-gray-700">Program Aktif</h3>
                            <p class="text-2xl font-bold text-green-700">15</p>
                        </div>
                        <span class="text-gray-500 text-sm mt-3">Program</span>
                    </div>
                </a>

                <!-- CARD 6: Regulasi -->
                <a href="#" class="block h-full">
                    <div
                        class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg hover:scale-105 transition cursor-pointer border-t-4 border-green-600 h-full flex flex-col justify-between text-center">
                        <div>
                            <div class="flex justify-center mb-3">
                                <img src="{{ asset('images/ikon_kertas_pengumuman.png') }}" class="h-10"
                                     alt="Icon Regulasi">
                            </div>
                            <h3 class="font-semibold text-sm mb-2 text-gray-700">Regulasi</h3>
                            <p class="text-lg font-bold text-green-700">12</p>
                        </div>
                        <span class="text-gray-500 text-xs mt-3">Terkait Desa</span>
                    </div>
                </a>

            </div>
        </div>
    </section>

</div>
@endsection
