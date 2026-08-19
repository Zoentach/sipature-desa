<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sipature Desa')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Latar belakang diubah ke slate-50 agar tidak putih pucat -->
<body class="bg-slate-50 dark:bg-gray-900 flex flex-col min-h-screen text-slate-700">

<!-- NAVBAR (Glassmorphism dengan Aksen Garis Atas Hijau) -->
<nav
    class="fixed w-full z-30 top-0 bg-white/90 backdrop-blur-md border-b border-gray-200 border-t-4 border-t-emerald-600 shadow-sm transition-all duration-300">

    <!-- CONTAINER NAVBAR (Sejajar dengan konten Hero) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-between py-3">

        <!-- LOGO KIRI -->
        <a href="{{ route('beranda') }}" class="flex items-center space-x-3 group">
            <img src="{{ asset('images/logo_tapsel.png') }}"
                 class="h-9 md:h-11 transition-transform duration-300 group-hover:scale-105"
                 alt="Logo Tapanuli Selatan">
            <span class="text-xl md:text-2xl font-extrabold text-emerald-900 tracking-tight">Sipature Desa</span>
        </a>

        <!-- TOMBOL KANAN & HAMBURGER -->
        <div class="flex md:order-2 space-x-3">
            <!-- Tombol Desktop: Emas Elegan -->
            <a href="{{ route('login') }}" class="hidden md:block">
                <button
                    class="text-white bg-amber-500 hover:bg-amber-600 font-semibold px-6 py-2.5 rounded-lg text-sm shadow-md hover:shadow-lg transition-all hover:-translate-y-0.5">
                    Portal Admin
                </button>
            </a>

            <!-- Tombol Hamburger -->
            <button data-collapse-toggle="navbar-sticky" type="button"
                    class="md:hidden p-2 w-10 h-10 text-emerald-800 rounded-lg hover:bg-emerald-50 focus:ring-2 focus:ring-emerald-200">
                ☰
            </button>
        </div>

        <!-- MENU TENGAH -->
        <div class="hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col md:flex-row md:space-x-8 mt-4 md:mt-0 font-medium">

                <!-- Menu Beranda -->
                <li>
                    <a href="{{ route('beranda') }}"
                       class="{{ request()->routeIs('beranda') ? 'text-emerald-700 font-bold block py-2 md:py-0 border-b-2 border-emerald-700' : 'text-gray-600 block py-2 md:py-0 hover:text-emerald-700 transition-colors' }}">
                        Beranda
                    </a>
                </li>

                <!-- Menu Tentang Kami -->
                <li>
                    <a href="{{ route('tentang') }}"
                       class="{{ request()->routeIs('tentang') ? 'text-emerald-700 font-bold block py-2 md:py-0 border-b-2 border-emerald-700' : 'text-gray-600 block py-2 md:py-0 hover:text-emerald-700 transition-colors' }}">
                        Tentang Kami
                    </a>
                </li>

                <!-- Tombol Mobile -->
                <li class="md:hidden mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('login') }}" class="block w-full">
                        <button
                            class="w-full text-white bg-amber-500 hover:bg-amber-600 font-bold px-4 py-3 rounded-lg text-sm shadow text-center">
                            Portal Admin
                        </button>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<!-- CONTENT -->
<main class="flex-grow pt-28 pb-10">
    @yield('content')
</main>

<!-- FOOTER TEMA HIJAU GELAP -->
<footer class="bg-emerald-950 text-gray-300 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5 pointer-events-none bg-[url('/images/pattern.svg')] bg-cover"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        <div class="grid md:grid-cols-4 gap-10">
            <!-- BRAND -->
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ asset('images/logo_tapsel.png') }}" class="h-10">
                    <div>
                        <h3 class="font-bold text-lg text-white">DPMD Tapanuli Selatan</h3>
                        <p class="text-sm text-emerald-400">Sipature Desa</p>
                    </div>
                </div>
                <p class="text-sm leading-relaxed text-gray-400">
                    Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Tapanuli Selatan berperan dalam meningkatkan
                    kapasitas desa dan mendorong pembangunan berbasis masyarakat.
                </p>
            </div>

            <!-- MENU FOOTER -->
            <div>
                <h4 class="font-semibold text-white mb-4">Menu Bantuan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('beranda') }}"
                           class="hover:text-amber-400 transition duration-300">Beranda</a></li>
                    <li><a href="#" class="hover:text-amber-400 transition duration-300">Profil</a></li>
                    <li><a href="#" class="hover:text-amber-400 transition duration-300">Regulasi</a></li>
                    <li><a href="#" class="hover:text-amber-400 transition duration-300">Kontak</a></li>
                </ul>
            </div>

            <!-- KONTAK -->
            <div>
                <h4 class="font-semibold text-white mb-4">Hubungi Kami</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>📍 Sipirok, Tapanuli Selatan</li>
                    <li>📧 dpmd@tapselkab.go.id</li>
                    <li>📞 (0634) xxxx</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-emerald-800/50 mt-10 pt-6 text-center text-sm text-emerald-300/60">
            © {{ date('Y') }} Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Tapanuli Selatan. All Rights Reserved.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
