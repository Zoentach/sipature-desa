@extends('guest.app')

@section('title', 'Tentang Kami - DPMD Tapanuli Selatan')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">

    <!-- HEADER HALAMAN -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-extrabold text-emerald-900">
            Tentang Kami
        </h1>
        <p class="text-gray-500 mt-1">Profil Instansi & Informasi Resmi Dinas Pemberdayaan Masyarakat dan Desa</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- SIDEBAR MENU NAVIGASI -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100 sticky top-28">
                <ul class="space-y-2 text-sm font-medium">
                    <li>
                        <button onclick="showContent('umum', this)"
                                class="menu-item w-full text-left px-4 py-3 rounded-xl bg-emerald-700 text-white shadow-sm transition-all">
                            Informasi Umum
                        </button>
                    </li>
                    <li>
                        <button onclick="showContent('visi', this)"
                                class="menu-item w-full text-left px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-800 transition-all">
                            Visi & Misi
                        </button>
                    </li>
                    <li>
                        <button onclick="showContent('struktur', this)"
                                class="menu-item w-full text-left px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-800 transition-all">
                            Struktur Organisasi
                        </button>
                    </li>
                    <li>
                        <button onclick="showContent('tugas', this)"
                                class="menu-item w-full text-left px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-800 transition-all">
                            Tugas & Fungsi
                        </button>
                    </li>
                    <li>
                        <button onclick="showContent('sejarah', this)"
                                class="menu-item w-full text-left px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-800 transition-all">
                            Sejarah
                        </button>
                    </li>
                    <li>
                        <button onclick="showContent('kontak', this)"
                                class="menu-item w-full text-left px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-800 transition-all">
                            Kontak
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- CONTENT AREA -->
        <div class="md:col-span-3 space-y-6">
            @include('guest.tentang.umum')
            @include('guest.tentang.visi')
            @include('guest.tentang.struktur')
            @include('guest.tentang.tugas')
            @include('guest.tentang.sejarah')
            @include('guest.tentang.kontak')
        </div>

    </div>
</div>

<!-- SCRIPT TAB KONTROL -->
<script>
    function showContent(id, el) {
        document.querySelectorAll('.content-section').forEach(c => c.classList.add('hidden'));
        document.getElementById(id).classList.remove('hidden');

        document.querySelectorAll('.menu-item').forEach(btn => {
            btn.classList.remove('bg-emerald-700', 'text-white', 'shadow-sm');
            btn.classList.add('text-gray-600', 'hover:bg-emerald-50', 'hover:text-emerald-800');
        });

        el.classList.add('bg-emerald-700', 'text-white', 'shadow-sm');
        el.classList.remove('text-gray-600', 'hover:bg-emerald-50', 'hover:text-emerald-800');
    }
</script>

@endsection
