<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sipature Desa')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 flex flex-col min-h-screen">

<!-- NAVBAR -->
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <a href="{{ route('beranda') }}" class="flex items-center space-x-3">
            <img src="{{ asset('images/logo_tapsel.png') }}" class="h-8" alt="Logo">
            <span class="text-2xl font-semibold dark:text-white">Sipature Desa</span>
        </a>

        <div class="flex md:order-2 space-x-3">
            <a href="{{ route('login') }}">
                <button class="text-white bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg text-sm">
                    Masuk
                </button>
            </a>

            <button data-collapse-toggle="navbar-sticky" type="button"
                    class="md:hidden p-2 w-10 h-10 text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                ☰
            </button>
        </div>

        <div class="hidden w-full md:flex md:w-auto" id="navbar-sticky">
            <ul class="flex flex-col md:flex-row md:space-x-8 mt-4 md:mt-0 font-medium">

                <li>
                    <a href="{{ route('beranda') }}"
                       class="{{ request()->routeIs('beranda') ? 'text-blue-700 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">
                        Beranda
                    </a>
                </li>

                <li>
                    <a href="{{ route('tentang') }}"
                       class="{{ request()->routeIs('tentang') ? 'text-blue-700 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">
                        Tentang Kami
                    </a>
                </li>

                <!--   <li>
                       <a href="#"
                          class="{{ request()->routeIs('regulasi') ? 'text-blue-700 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">
                           Regulasi
                       </a>
                   </li>

                   <li>
                       <a href="#"
                          class="{{ request()->routeIs('kontak') ? 'text-blue-700 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">
                           Kontak
                       </a>
                   </li> -->

            </ul>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="flex-grow pt-24 pb-10 px-4">
    @yield('content')
</main>

<!-- WAVE SEPARATOR -->
<div class="bg-white">
    <svg viewBox="0 0 1440 100" class="w-full">
        <path fill="#f3f4f6" d="M0,64L1440,0L1440,320L0,320Z"></path>
    </svg>
</div>

<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-300 bg-[url('/images/pattern.svg')] bg-cover">

    <div class="max-w-screen-xl mx-auto px-6 py-12">

        <div class="grid md:grid-cols-4 gap-10">

            <!-- BRAND -->
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ asset('images/logo_tapsel.png') }}" class="h-10">
                    <div>
                        <h3 class="font-bold text-lg text-white">DPMD Tapanuli Selatan</h3>
                        <p class="text-sm text-gray-400">Sipature Desa</p>
                    </div>
                </div>

                <p class="text-sm leading-relaxed text-gray-400">
                    Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Tapanuli Selatan
                    berperan dalam meningkatkan kapasitas desa, memperkuat ekonomi desa,
                    serta mendorong pembangunan berbasis masyarakat.
                </p>
            </div>

            <!-- MENU -->
            <div>
                <h4 class="font-semibold text-white mb-4">Menu</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('beranda') }}"
                           class="hover:text-white hover:opacity-80 transition duration-300">Beranda</a>
                    </li>
                    <li><a href="#"
                           class="hover:text-white hover:opacity-80 transition duration-300">Profil</a></li>
                    <li><a href="#" class="hover:text-white hover:opacity-80 transition duration-300">Regulasi</a></li>
                    <li><a href="#" class="hover:text-white hover:opacity-80 transition duration-300">Kontak</a></li>
                </ul>
            </div>

            <!-- KONTAK -->
            <div>
                <h4 class="font-semibold text-white mb-4">Kontak</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>📍 Tapanuli Selatan, Sumatera Utara</li>
                    <li>📧 dpmd@tapselkab.go.id</li>
                    <li>📞 (0634) xxxx</li>
                </ul>
            </div>

            <!-- IDENTITAS -->
            <div class="flex flex-col items-center md:items-start">
                <img src="{{ asset('images/logo_tapsel.png') }}" class="h-16 mb-3">

                <p class="text-center md:text-left text-sm text-gray-400">
                    SIPATURE<br>
                    <span class="text-xs">Bersama Membangun Desa</span>
                </p>

                <!-- SOSIAL MEDIA -->
                <div class="flex space-x-4 mt-4 text-lg">
                    <a href="#" class="hover:text-white hover:scale-110 transition duration-300">🌐</a>
                    <a href="#" class="hover:text-white hover:scale-110 transition duration-300">📘</a>
                    <a href="#" class="hover:text-white hover:scale-110 transition duration-300">📷</a>
                </div>
            </div>

        </div>

        <!-- DIVIDER -->
        <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm text-gray-500">
            © {{ date('Y') }} Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Tapanuli Selatan.
            All Rights Reserved.
        </div>

    </div>

</footer>

<!-- BACK TO TOP BUTTON -->
<button onclick="window.scrollTo({top:0, behavior:'smooth'})"
        class="fixed bottom-6 right-6 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 hover:scale-110 transition duration-300">
    ↑
</button>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
