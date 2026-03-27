@extends('guest.app')

@section('title', 'Profil DPMD')

@section('content')

<div class="max-w-screen-xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h1 class="text-3xl font-bold text-blue-700">Profil DPMD</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- SIDEBAR -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow p-4">

                <ul class="space-y-2 text-sm">
                    <li>
                        <button onclick="showContent('umum')"
                                class="w-full text-left px-3 py-2 rounded bg-blue-700 text-white">
                            Informasi Umum
                        </button>
                    </li>
                    <li>
                        <button onclick="showContent('visi')"
                                class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded">Visi & Misi
                        </button>
                    </li>
                    <li>
                        <button onclick="showContent('struktur')"
                                class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded">Struktur Organisasi
                        </button>
                    </li>
                    <li>
                        <button onclick="showContent('tugas')"
                                class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded">Tugas & Fungsi
                        </button>
                    </li>
                    <li>
                        <button onclick="showContent('sejarah')"
                                class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded">Sejarah
                        </button>
                    </li>
                    <li>
                        <button onclick="showContent('kontak')"
                                class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded">Kontak
                        </button>
                    </li>
                </ul>

            </div>
        </div>

        <!-- CONTENT -->
        <div class="md:col-span-3">

            <!-- INFORMASI UMUM -->
            <div id="umum" class="content-section">
                <h2 class="text-xl font-bold text-blue-700 mb-4">Informasi Umum</h2>

                <p class="mb-4">
                    Dinas Pemberdayaan Masyarakat dan Desa (DPMD) Kabupaten Tapanuli Selatan
                    merupakan perangkat daerah yang memiliki tugas membantu Bupati dalam
                    melaksanakan urusan pemerintahan di bidang pemberdayaan masyarakat desa.
                </p>

                <p class="mb-4">
                    DPMD berperan dalam meningkatkan kapasitas desa, memperkuat kelembagaan,
                    serta mendorong pembangunan desa yang mandiri, transparan, dan berkelanjutan.
                </p>

                <ul class="list-disc ml-6 space-y-2">
                    <li>Pemberdayaan masyarakat desa</li>
                    <li>Pembinaan pemerintahan desa</li>
                    <li>Penguatan ekonomi desa</li>
                    <li>Pengelolaan data dan informasi desa</li>
                </ul>
            </div>

            <!-- VISI MISI -->
            <div id="visi" class="content-section hidden">
                <h2 class="text-xl font-bold text-blue-700 mb-4">Visi & Misi</h2>

                <h3 class="font-semibold">Visi</h3>
                <p class="mb-4">
                    Terwujudnya desa yang mandiri, sejahtera, dan berdaya saing.
                </p>

                <h3 class="font-semibold">Misi</h3>
                <ul class="list-disc ml-6 space-y-2">
                    <li>Meningkatkan kapasitas aparatur desa</li>
                    <li>Mendorong partisipasi masyarakat</li>
                    <li>Mengembangkan potensi ekonomi desa</li>
                    <li>Meningkatkan kualitas pelayanan publik desa</li>
                </ul>
            </div>

            <!-- STRUKTUR -->
            <div id="struktur" class="content-section hidden">
                <h2 class="text-xl font-bold text-blue-700 mb-4">Struktur Organisasi</h2>

                <ul class="list-disc ml-6 space-y-2">
                    <li>Kepala Dinas</li>
                    <li>Sekretariat</li>
                    <li>Bidang Pemerintahan Desa</li>
                    <li>Bidang Pemberdayaan Masyarakat</li>
                    <li>Bidang Pengembangan Ekonomi Desa</li>
                </ul>
            </div>

            <!-- TUGAS -->
            <div id="tugas" class="content-section hidden">
                <h2 class="text-xl font-bold text-blue-700 mb-4">Tugas & Fungsi</h2>

                <ul class="list-disc ml-6 space-y-2">
                    <li>Menyusun kebijakan teknis bidang desa</li>
                    <li>Melaksanakan pembinaan dan pengawasan desa</li>
                    <li>Meningkatkan kapasitas kelembagaan desa</li>
                    <li>Menyediakan data dan informasi desa</li>
                    <li>Melaksanakan pemberdayaan masyarakat desa</li>
                </ul>
            </div>

            <!-- SEJARAH -->
            <div id="sejarah" class="content-section hidden">
                <h2 class="text-xl font-bold text-blue-700 mb-4">Sejarah</h2>

                <p>
                    DPMD merupakan bagian dari perangkat daerah yang dibentuk untuk
                    memperkuat pembangunan desa seiring dengan diberlakukannya kebijakan
                    otonomi daerah dan Undang-Undang Desa.
                </p>
            </div>

            <!-- KONTAK -->
            <div id="kontak" class="content-section hidden">
                <h2 class="text-xl font-bold text-blue-700 mb-4">Kontak</h2>

                <p>Alamat: Kabupaten Tapanuli Selatan</p>
                <p>Email: dpmd@tapselkab.go.id</p>
                <p>Telepon: (0000) 000000</p>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPT SWITCH CONTENT -->
<script>
    function showContent(id) {
        document.querySelectorAll('.content-section').forEach(el => el.classList.add('hidden'));
        document.getElementById(id).classList.remove('hidden');
    }
</script>

@endsection
