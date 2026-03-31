@extends('guest.app')

@section('title', 'Profil DPMD')

@section('content')

<div class="max-w-screen-xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-blue-700">
            Tentang Kami
        </h1>
        <p class="text-gray-500 mt-2">Profil Instansi & Informasi Resmi</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- SIDEBAR -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-xl shadow p-4">

                <ul class="space-y-2 text-sm">

                    <li>
                        <button onclick="showContent('umum', this)"
                                class="menu-item w-full text-left px-4 py-2 rounded-lg bg-blue-700 text-white">
                            Informasi Umum
                        </button>
                    </li>

                    <li>
                        <button onclick="showContent('visi', this)"
                                class="menu-item w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                            Visi & Misi
                        </button>
                    </li>

                    <li>
                        <button onclick="showContent('struktur', this)"
                                class="menu-item w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                            Struktur Organisasi
                        </button>
                    </li>

                    <li>
                        <button onclick="showContent('tugas', this)"
                                class="menu-item w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                            Tugas & Fungsi
                        </button>
                    </li>

                    <li>
                        <button onclick="showContent('sejarah', this)"
                                class="menu-item w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                            Sejarah
                        </button>
                    </li>

                    <li>
                        <button onclick="showContent('kontak', this)"
                                class="menu-item w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                            Kontak
                        </button>
                    </li>

                </ul>

            </div>
        </div>

        <!-- CONTENT -->
        <div class="md:col-span-3">

            <!-- INFORMASI UMUM -->
            <div id="umum" class="content-section">
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-xl font-bold text-blue-700 mb-4">Informasi Umum</h2>

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
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-xl font-bold text-blue-700 mb-4">Visi & Misi</h2>

                    <h3 class="font-semibold text-gray-800">Visi</h3>
                    <p class="mb-4 text-gray-700">
                        Terwujudnya desa yang mandiri, sejahtera, dan berdaya saing.
                    </p>

                    <h3 class="font-semibold text-gray-800">Misi</h3>
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
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-xl font-bold text-blue-700 mb-4">Struktur Organisasi</h2>

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
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-xl font-bold text-blue-700 mb-4">Tugas & Fungsi</h2>

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
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-xl font-bold text-blue-700 mb-4">Sejarah</h2>

                    <p class="text-gray-700">
                        DPMD merupakan bagian dari perangkat daerah yang dibentuk untuk
                        memperkuat pembangunan desa seiring dengan diberlakukannya kebijakan
                        otonomi daerah dan Undang-Undang Desa.
                    </p>
                </div>
            </div>

            <!-- KONTAK -->
            <div id="kontak" class="content-section hidden">
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-xl font-bold text-blue-700 mb-4">Kontak</h2>

                    <p class="text-gray-700">📍 Tapanuli Selatan</p>
                    <p class="text-gray-700">📧 dpmd@tapselkab.go.id</p>
                    <p class="text-gray-700">📞 (0634) xxxx</p>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    function showContent(id, el) {

        // hide semua content
        document.querySelectorAll('.content-section')
            .forEach(c => c.classList.add('hidden'));

        // tampilkan yang dipilih
        document.getElementById(id).classList.remove('hidden');

        // reset semua menu
        document.querySelectorAll('.menu-item').forEach(btn => {
            btn.classList.remove('bg-blue-700', 'text-white');
            btn.classList.add('hover:bg-gray-100');
        });

        // set active
        el.classList.add('bg-blue-700', 'text-white');
        el.classList.remove('hover:bg-gray-100');
    }
</script>

@endsection
