<div id="struktur" class="content-section hidden">
    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">

        <!-- HEADER BAGIAN -->
        <div class="mb-6 border-b border-gray-100 pb-2">
            <h2 class="text-2xl font-bold text-emerald-900">Struktur Organisasi</h2>
        </div>

        <p class="mb-8 text-gray-700 leading-relaxed text-justify">
            Struktur Organisasi Dinas Pemberdayaan Masyarakat dan Desa (DPMD) Daerah Kabupaten Tapanuli Selatan
            dirancang untuk mengoptimalkan pelayanan, pembinaan, dan pelaksanaan tugas di bidang pemberdayaan masyarakat
            serta pemerintahan desa.
        </p>

        <!-- GAMBAR STRUKTUR ORGANISASI -->
        <div class="flex flex-col items-center mb-10">
            <!-- Pastikan gambar struktur_organisasi.jpeg berada di dalam folder public/images/ -->
            <img src="{{ asset('images/struktur_organisasi.jpeg') }}"
                 alt="Bagan Struktur Organisasi DPMD Kabupaten Tapanuli Selatan"
                 class="w-full max-w-4xl rounded-xl shadow-lg border border-gray-100 mb-4 transition-transform hover:scale-[1.01] duration-300">
            <span class="text-sm text-gray-500 text-center font-medium bg-gray-50 px-4 py-1 rounded-full">
                Bagan Struktur Organisasi DPMD Kabupaten Tapanuli Selatan
            </span>
        </div>

        <!-- TEKS SUSUNAN ORGANISASI (Opsional tapi bagus untuk UI) -->
        <div class="bg-emerald-50/50 rounded-xl p-6 border border-emerald-100">
            <h3 class="font-bold text-emerald-800 mb-4 text-lg border-l-4 border-emerald-500 pl-3">Susunan Hierarki</h3>
            <ul class="space-y-4 text-gray-700 ml-2">

                <li class="flex items-start">
                    <span class="text-emerald-500 mr-3 text-lg leading-none">■</span>
                    <div><strong class="text-emerald-900">Kepala Dinas</strong></div>
                </li>

                <li class="flex items-start">
                    <span class="text-emerald-500 mr-3 text-lg leading-none">■</span>
                    <div>
                        <strong class="text-emerald-900">Sekretariat Dinas</strong>, membawahi:
                        <ul class="list-disc ml-6 mt-2 text-gray-600 space-y-1">
                            <li>Subbagian Umum dan Kepegawaian</li>
                            <li>Subbagian Perencanaan dan Keuangan</li>
                        </ul>
                    </div>
                </li>

                <li class="flex items-start">
                    <span class="text-emerald-500 mr-3 text-lg leading-none">■</span>
                    <div><strong class="text-emerald-900">Bidang Pemerintahan Desa</strong></div>
                </li>

                <li class="flex items-start">
                    <span class="text-emerald-500 mr-3 text-lg leading-none">■</span>
                    <div><strong class="text-emerald-900">Bidang Pemberdayaan Ekonomi Masyarakat Desa</strong></div>
                </li>

                <li class="flex items-start">
                    <span class="text-emerald-500 mr-3 text-lg leading-none">■</span>
                    <div><strong class="text-emerald-900">Bidang Pemberdayaan Kelembagaan Masyarakat Desa</strong></div>
                </li>

                <li class="flex items-start">
                    <span class="text-emerald-500 mr-3 text-lg leading-none">■</span>
                    <div class="text-justify">
                        <strong class="text-emerald-900">Kelompok Jabatan Fungsional</strong>
                        <span class="block mt-1 text-sm text-gray-600">(Terdiri dari berbagai jenjang seperti Ahli Muda, Ahli Pertama, dan tenaga operasional lainnya yang tersebar di sekretariat maupun masing-masing bidang sesuai keahliannya).</span>
                    </div>
                </li>

            </ul>
        </div>

    </div>
</div>
