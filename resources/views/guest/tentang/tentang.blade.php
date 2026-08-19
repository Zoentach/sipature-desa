@extends('guest.app')

@section('title', 'Tentang Kami - DPMD Tapanuli Selatan')

@section('content')

<!-- CONTAINER UTAMA (Sejajar dengan Navbar & Beranda) -->
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

            <!-- INFORMASI UMUM -->
            <div id="umum" class="content-section">
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                    <h2 class="text-xl font-bold text-emerald-900 mb-4 pb-2 border-b border-gray-100">Informasi
                        Umum</h2>

                    <p class="mb-4 text-gray-700 leading-relaxed">
                        Dinas Pemberdayaan Masyarakat dan Desa (DPMD) Kabupaten Tapanuli Selatan
                        merupakan perangkat daerah yang memiliki tugas membantu Bupati dalam
                        melaksanakan urusan pemerintahan di bidang pemberdayaan masyarakat desa.
                    </p>

                    <p class="mb-4 text-gray-700 leading-relaxed">
                        DPMD berperan dalam meningkatkan kapasitas desa, memperkuat kelembagaan,
                        serta mendorong pembangunan desa yang mandiri, transparan, dan berkelanjutan.
                    </p>

                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li>Pemberdayaan masyarakat desa</li>
                        <li>Pembinaan pemerintahan desa</li>
                        <li>Penguatan ekonomi desa</li>
                        <li>Pengelolaan data dan informasi desa</li>
                    </ul>
                </div>
            </div>

            <!-- VISI MISI -->
            <div id="visi" class="content-section hidden">
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                    <h2 class="text-xl font-bold text-emerald-900 mb-4 pb-2 border-b border-gray-100">Visi & Misi</h2>

                    <h3 class="font-semibold text-emerald-800 mb-1">Visi</h3>
                    <p class="mb-6 text-gray-700 italic bg-emerald-50 p-4 rounded-xl border border-emerald-100">
                        "Terwujudnya desa yang mandiri, sejahtera, dan berdaya saing."
                    </p>

                    <h3 class="font-semibold text-emerald-800 mb-2">Misi</h3>
                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li>Meningkatkan kapasitas aparatur desa</li>
                        <li>Mendorong partisipasi masyarakat</li>
                        <li>Mengembangkan potensi ekonomi desa</li>
                        <li>Meningkatkan kualitas pelayanan publik desa</li>
                    </ul>
                </div>
            </div>

            <!-- STRUKTUR -->
            <div id="struktur" class="content-section hidden">
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                    <h2 class="text-xl font-bold text-emerald-900 mb-4 pb-2 border-b border-gray-100">Struktur
                        Organisasi</h2>

                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li>Kepala Dinas</li>
                        <li>Sekretariat</li>
                        <li>Bidang Pemerintahan Desa</li>
                        <li>Bidang Pemberdayaan Masyarakat</li>
                        <li>Bidang Pengembangan Ekonomi Desa</li>
                    </ul>
                </div>
            </div>

            <!-- TUGAS -->
            <div id="tugas" class="content-section hidden">
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                    <h2 class="text-xl font-bold text-emerald-900 mb-4 pb-2 border-b border-gray-100">Tugas &
                        Fungsi</h2>

                    <ul class="list-disc ml-6 space-y-2 text-gray-700">
                        <li>Menyusun kebijakan teknis bidang desa</li>
                        <li>Melaksanakan pembinaan dan pengawasan desa</li>
                        <li>Meningkatkan kapasitas kelembagaan desa</li>
                        <li>Menyediakan data dan informasi desa</li>
                        <li>Melaksanakan pemberdayaan masyarakat desa</li>
                    </ul>
                </div>
            </div>

            <!-- SEJARAH -->
            <div id="sejarah" class="content-section hidden">
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                    <h2 class="text-xl font-bold text-emerald-900 mb-4 pb-2 border-b border-gray-100">Sejarah</h2>

                    <p class="text-gray-700 leading-relaxed">
                        DPMD merupakan bagian dari perangkat daerah yang dibentuk untuk
                        memperkuat pembangunan desa seiring dengan diberlakukannya kebijakan
                        otonomi daerah dan Undang-Undang Desa.
                    </p>
                </div>
            </div>

            <!-- KONTAK -->
            <div id="kontak" class="content-section hidden">
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                    <h2 class="text-xl font-bold text-emerald-900 mb-4 pb-2 border-b border-gray-100">Kontak</h2>

                    <div class="space-y-3 text-gray-700">
                        <p class="flex items-center space-x-3"><span>📍</span>
                            <span>Tapanuli Selatan, Sumatera Utara</span></p>
                        <p class="flex items-center space-x-3"><span>📧</span> <span>dpmd@tapselkab.go.id</span></p>
                        <p class="flex items-center space-x-3"><span>📞</span> <span>(0634) xxxx</span></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPT TAB KONTROL -->
<script>
    function showContent(id, el) {
        // hide semua content
        document.querySelectorAll('.content-section')
            .forEach(c => c.classList.add('hidden'));

        // tampilkan yang dipilih
        document.getElementById(id).classList.remove('hidden');

        // reset semua menu ke kondisi non-aktif (warna abu-abu & hover hijau muda)
        document.querySelectorAll('.menu-item').forEach(btn => {
            btn.classList.remove('bg-emerald-700', 'text-white', 'shadow-sm');
            btn.classList.add('text-gray-600', 'hover:bg-emerald-50', 'hover:text-emerald-800');
        });

        // set tombol aktif ke warna emerald-700
        el.classList.add('bg-emerald-700', 'text-white', 'shadow-sm');
        el.classList.remove('text-gray-600', 'hover:bg-emerald-50', 'hover:text-emerald-800');
    }
</script>

@endsection
