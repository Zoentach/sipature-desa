<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasbor Admin - Sipature Desa')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <livewire:styles/>
    @stack('styles')
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-700">

<!-- TOPBAR (NAVBAR) -->
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">

            <!-- BAGIAN KIRI: Logo & Tombol Toggle Mobile -->
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                        type="button"
                        class="inline-flex items-center p-2 text-sm text-emerald-800 rounded-lg sm:hidden hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-200">
                    <span class="sr-only">Buka sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="{{ route('beranda') }}" class="flex ms-2 md:me-24 items-center gap-3">
                    <img src="{{ asset('images/logo_tapsel.png') }}" class="h-8" alt="Logo Tapsel"/>
                    <span
                        class="self-center text-xl font-extrabold sm:text-2xl whitespace-nowrap text-emerald-900 tracking-tight">Sipature Desa</span>
                </a>
            </div>

            <!-- BAGIAN KANAN: Identitas Pengguna & Dropdown -->
            <div class="flex items-center">
                <div class="flex items-center ms-3 gap-3 relative">
                    <!-- Teks Nama Pengguna (Tersembunyi di layar kecil) -->
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-xs text-emerald-600 font-medium">{{ Auth::user()->email ??
                            'admin@tapselkab.go.id' }}</p>
                    </div>

                    <!-- Tombol Avatar -->
                    <button type="button"
                            class="flex text-sm bg-emerald-100 rounded-full focus:ring-4 focus:ring-emerald-200 border-2 border-white shadow-sm"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Buka menu pengguna</span>
                        <div
                            class="w-9 h-9 rounded-full flex items-center justify-center text-emerald-700 font-bold bg-emerald-100">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                    </button>

                    <!-- Menu Dropdown (Muncul saat diklik) -->
                    <div
                        class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-xl shadow-lg border border-gray-100 min-w-48"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 font-bold" role="none">
                                {{ Auth::user()->name ?? 'Administrator' }}
                            </p>
                            <p class="text-sm font-medium text-gray-500 truncate" role="none">
                                {{ Auth::user()->email ?? 'admin@tapselkab.go.id' }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700"
                                   role="menuitem">Pengaturan Profil</a>
                            </li>
                            <!-- Form Logout Laravel -->
                            <li>
                                <!-- Form Logout Biasa untuk Master Blade -->

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm font-bold text-red-600 hover:bg-red-50"
                                            role="menuitem">
                                        Keluar (Logout)
                                    </button>
                                </form>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- SIDEBAR (Bilah Samping Tema Emerald Gelap) -->
<aside id="logo-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-emerald-950 border-r border-emerald-900 sm:translate-x-0 shadow-xl"
       aria-label="Sidebar">
    <!-- Area Menu -->
    <div class="h-full px-3 pb-20 overflow-y-auto bg-emerald-950 scrollbar-thin scrollbar-thumb-emerald-800">
        <ul class="space-y-1 font-medium">

            <!-- Menu Dasbor Utama -->
            <li class="mb-4">
                <a href="#"
                   class="flex items-center p-2.5 text-white rounded-lg bg-emerald-800 group border-l-4 border-amber-500 shadow-md">
                    <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 22 21"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3 font-semibold">Dasbor</span>
                </a>
            </li>

            <!-- MENU: Sekretaris -->
            <li>
                <button type="button"
                        class="flex items-center w-full p-2.5 text-base text-emerald-100 transition duration-75 rounded-lg group hover:bg-emerald-900 hover:text-white"
                        aria-controls="sekretaris" data-collapse-toggle="sekretaris">
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Sekretaris</span>
                    <svg class="w-3 h-3 text-emerald-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="sekretaris" class="hidden py-1 space-y-1">
                    <li><a href="{{ route('regulasi.index') }}"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Peraturan</a>
                    </li>
                    <li><a href="{{ route('pegawai.index') }}"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Pegawai</a>
                    </li>
                    <li><a href="{{ route('perjalanan-dinas.index') }}"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Tugas
                            Luar</a></li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Absensi
                            Tamu</a></li>
                </ul>
            </li>

            <!-- MENU: Pemdes -->
            <li>
                <button type="button"
                        class="flex items-center w-full p-2.5 text-base text-emerald-100 transition duration-75 rounded-lg group hover:bg-emerald-900 hover:text-white"
                        aria-controls="pemdes" data-collapse-toggle="pemdes">
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Pemdes</span>
                    <svg class="w-3 h-3 text-emerald-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="pemdes" class="hidden py-1 space-y-1">
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">BPD</a>
                    </li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Pemuka
                            Agama</a></li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Penerima
                            BLT</a></li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">IDM</a>
                    </li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Peraturan
                            Bupati/Daerah</a></li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Anggaran
                            Desa</a></li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Aset
                            & Pengadaan</a></li>
                </ul>
            </li>

            <!-- MENU: Ekonomi -->
            <li>
                <button type="button"
                        class="flex items-center w-full p-2.5 text-base text-emerald-100 transition duration-75 rounded-lg group hover:bg-emerald-900 hover:text-white"
                        aria-controls="ekonomi" data-collapse-toggle="ekonomi">
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Ekonomi</span>
                    <svg class="w-3 h-3 text-emerald-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="ekonomi" class="hidden py-1 space-y-1">
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Bumdes</a>
                    </li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Kopdes</a>
                    </li>
                </ul>
            </li>

            <!-- MENU: Kelembagaan -->
            <li>
                <button type="button"
                        class="flex items-center w-full p-2.5 text-base text-emerald-100 transition duration-75 rounded-lg group hover:bg-emerald-900 hover:text-white"
                        aria-controls="kelembagaan" data-collapse-toggle="kelembagaan">
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Kelembagaan</span>
                    <svg class="w-3 h-3 text-emerald-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="kelembagaan" class="hidden py-1 space-y-1">
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">LPMD
                            / SK</a></li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">PKK
                            / SK</a></li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Kader
                            Posyandu</a></li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Tokoh
                            Adat</a></li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Desa
                            Binaan</a></li>
                    <li><a href="#"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Juknis
                            PTP2WKSS</a></li>
                </ul>
            </li>

            <!-- MENU: SAPA DESA -->
            <li>
                <button type="button"
                        class="flex items-center w-full p-2.5 text-base text-emerald-100 transition duration-75 rounded-lg group hover:bg-emerald-900 hover:text-white"
                        aria-controls="sapa_desa" data-collapse-toggle="sapa_desa">
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Sapa Desa</span>
                    <svg class="w-3 h-3 text-emerald-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="sapa_desa" class="hidden py-1 space-y-1">
                    <li><a href="{{ route('absensi.ringkasan') }}"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Ringkasan</a>
                    </li>
                    <li><a href="{{ route('absensi.index') }}"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Absensi</a>
                    </li>
                    <li><a href="{{ route('perangkat.index')}}"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Perangkat
                            Desa</a></li>
                    <li><a href="{{ route('absensi.device')}}"
                           class="flex items-center w-full p-2 text-sm text-emerald-200 transition duration-75 rounded-lg pl-11 hover:bg-emerald-800 hover:text-white">Daftar
                            Device</a>
                    </li>
            </li>

            <!-- MENU: Daftar Pengguna -->
            <li class="mt-4 pt-4 border-t border-emerald-800">
                <a href="{{ route ('pengguna.index') }}"
                   class="flex items-center p-2.5 text-emerald-100 rounded-lg hover:bg-emerald-900 hover:text-white group">
                    <svg class="shrink-0 w-5 h-5 text-emerald-400 group-hover:text-white transition duration-75"
                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                        <path
                            d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                        <path
                            d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Daftar Pengguna</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- MAIN CONTENT AREA -->
<main class="flex flex-col min-h-screen pt-16 sm:ml-64">

    <!-- Wrapper Konten Utama -->
    <div class="flex-1 p-4 lg:p-8">
        <!-- Kotak Putih tanpa border putus-putus -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 min-h-[500px]">
            @yield('content')
        </div>
    </div>

    <!-- FOOTER ADMIN SINGKAT & PROFESIONAL -->
    <footer class="p-4 bg-white border-t border-gray-200 mt-auto text-center">
        <span class="text-sm text-gray-500">
            © {{ date('Y') }} <a href="{{ route('beranda') }}" class="hover:underline font-semibold text-emerald-700">DPMD Tapanuli Selatan</a>. All Rights Reserved.
        </span>
    </footer>

</main>

<livewire:scripts/>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<!-- TAMBAHKAN SCRIPT INI DI BAWAHNYA -->
<script>
    document.addEventListener('livewire:navigated', () => {
        if (typeof initFlowbite === 'function') {
            initFlowbite();
        }
    });
</script>

@stack('scripts')
</body>
</html>
