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
                <li><a href="{{ route('beranda') }}" class="text-blue-700">Beranda</a></li>
                <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                <li><a href="#">Regulasi</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="flex-grow pt-24 pb-10 px-4">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-screen-xl mx-auto p-6 text-center text-gray-500">
        © {{ date('Y') }} Dinas PMD Tapanuli Selatan
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
