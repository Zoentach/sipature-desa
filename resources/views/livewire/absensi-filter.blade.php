<div>
    <!-- TOMBOL PENGAJUAN IZIN (Kanan Atas) -->
    <div class="flex justify-end mb-4">
        <button type="button" onclick="window.location='{{ route('absensi.izin') }}'"
                class="inline-flex items-center gap-2 text-white bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:ring-amber-200 font-bold text-sm px-5 py-2.5 rounded-xl shadow-md transition-all hover:-translate-y-0.5">
            <span>Pengajuan Izin</span>
            <span
                class="inline-flex items-center justify-center w-5 h-5 rounded-full text-xs font-bold bg-white text-amber-700 shadow-inner">
                {{ $this->izins ?? 0 }}
            </span>
        </button>
    </div>

    <!-- FILTER & PENCARIAN (Tema Modern) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">

            <!-- Filter Kecamatan -->
            <div>
                <label for="kecamatan" class="block mb-1.5 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Kecamatan
                </label>
                <select wire:model.live="kodeKec" id="kecamatan"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-900 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach($this->kecamatans as $kecamatan)
                    <option value="{{ $kecamatan->kode_kecamatan }}">{{ $kecamatan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Desa -->
            <div>
                <label for="desa" class="block mb-1.5 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Desa
                </label>
                <select wire:model.live="kodeDesa" id="desa"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-900 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    <option value="">-- Pilih Desa --</option>
                    @foreach($this->desas as $desa)
                    <option value="{{ $desa->kode_desa }}">{{ $desa->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dari Tanggal -->
            <div>
                <label for="fromDate" class="block mb-1.5 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Dari
                </label>
                <input type="date" wire:model.live="fromDate" id="fromDate"
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-900 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"/>
            </div>

            <!-- Sampai Tanggal -->
            <div>
                <label for="toDate" class="block mb-1.5 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Sampai
                </label>
                <input type="date" wire:model.live="toDate" id="toDate"
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-900 focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"/>
            </div>

            <!-- Tombol Cetak -->
            <div>
                <button type="button" wire:click="prints"
                        class="w-full inline-flex justify-center items-center gap-2 text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-200 font-bold text-sm px-5 py-2.5 rounded-xl shadow-md transition-all">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M6 9V4h12v5m-2 10H8v-4h8v4Zm3-4h1a1 1 0 0 0 1-1v-4a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v4a1 1 0 0 0 1 1h1"/>
                    </svg>
                    Cetak
                </button>
            </div>

        </div>
    </div>

    <!-- DAFTAR ABSENSI (Tabel Modern) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden my-4">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-emerald-900 uppercase bg-emerald-50 border-b border-gray-100 font-bold">
                <tr>
                    <th scope="col" class="px-4 py-4 text-center">Nama</th>
                    <th scope="col" class="px-4 py-4 text-center">Tanggal</th>
                    <th scope="col" class="w-40 px-4 py-4 text-center">Terlambat</th>
                    <th scope="col" class="w-40 px-4 py-4 text-center">Pulang Cepat</th>
                    <th scope="col" class="w-40 px-4 py-4 text-center">Gambar Pagi</th>
                    <th scope="col" class="w-40 px-4 py-4 text-center">Gambar Sore</th>
                    <th scope="col" class="w-40 px-4 py-4 text-center">Keterangan</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($this->absensi as $absensi)
                <tr class="hover:bg-emerald-50/30 transition-colors bg-white">
                    <td class="w-40 px-4 py-4 text-center font-semibold text-gray-900">
                        {{ $absensi->nama_perangkat }}
                    </td>
                    <td class="w-40 px-4 py-4 text-center text-gray-600">
                        {{ $absensi->tanggal->format('d M Y') }}
                    </td>
                    <td class="px-4 py-4 text-center">
                        @if($absensi->keterlambatan)
                        <span
                            class="bg-amber-50 text-amber-700 font-semibold px-2.5 py-1 rounded-lg text-xs border border-amber-200">
                                    {{ $absensi->keterlambatan }} menit
                                </span>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-center">
                        @if($absensi->pulang_cepat)
                        <span
                            class="bg-amber-50 text-amber-700 font-semibold px-2.5 py-1 rounded-lg text-xs border border-amber-200">
                                    {{ $absensi->pulang_cepat }} menit
                                </span>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-center">
                        @if($absensi->gambar_pagi)
                        <a href="{{ asset('storage/' . $absensi->gambar_pagi) }}" target="_blank"
                           class="inline-flex items-center font-bold text-emerald-700 hover:text-emerald-800 bg-emerald-50 px-3 py-1 rounded-lg text-xs transition-colors">Lihat</a>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-center">
                        @if($absensi->gambar_sore)
                        <a href="{{ asset('storage/' . $absensi->gambar_sore) }}" target="_blank"
                           class="inline-flex items-center font-bold text-emerald-700 hover:text-emerald-800 bg-emerald-50 px-3 py-1 rounded-lg text-xs transition-colors">Lihat</a>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    @php
                    $statusColor = [
                    'Ditolak' => 'bg-red-50 text-red-700 border border-red-200',
                    'Pending' => 'bg-amber-50 text-amber-700 border border-amber-200',
                    'Disetujui' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                    ];
                    $badgeClass = $statusColor[$absensi->status_kehadiran] ?? 'bg-gray-100 text-gray-700 border
                    border-gray-200';
                    @endphp

                    <td class="w-40 px-4 py-4 text-center">
                            <span class="inline-block px-3 py-1 rounded-lg text-xs font-bold {{ $badgeClass }}">
                                {{ $absensi->keterangan }}
                            </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-medium">
                        Tidak ada data absensi yang ditemukan.
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SCRIPT DI LUAR ROOT DIV (Aman untuk Livewire 3) -->
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('printAbsensi', data => {
            let tableContent = document.querySelector('table').outerHTML;
            let logoUrl = `{{ asset('images/logo_tapsel.png') }}`;
            let win = window.open('', '_blank', 'width=900,height=1200');

            win.document.write(`
            <html>
            <head>
                <title>Laporan Absensi Aparatur Desa</title>
                <style>
                    body { font-family: "Times New Roman", serif; margin:40px; }
                    .kop-container { display: flex; align-items: center; margin-bottom: 10px; }
                    .kop-left { width: 90px; }
                    .kop-logo { width: 90px; height: auto; }
                    .kop-right { flex: 1; text-align: center; margin-left: -90px; }
                    .kop-title { font-size: 20px; font-weight: bold; text-transform: uppercase; }
                    .kop-sub { font-size: 16px; text-transform: uppercase; }
                    .garis-kop { border-top:3px solid #000; border-bottom:1px solid #000; margin-top:10px; margin-bottom:30px; padding:2px 0; }
                    h2 { text-align:center; text-transform:uppercase; margin:20px 0; font-size: 16px;}
                    table { width:100%; border-collapse:collapse; }
                    table, th, td { border:1px solid #000; }
                    th, td { padding:8px; text-align:center; }
                    .ttd-container { width: 100%; margin-top: 40px; text-align: right; }
                    .ttd-wrapper { display: inline-block; text-align: left; font-size: 14px; line-height: 1.4; }
                    .ttd-wrapper .tanggal { margin-bottom: 5px; }
                    .ttd-wrapper .nama { margin-top: 60px; font-weight: bold; text-decoration: underline; }
                    @media print { @page { size:A4; margin:20mm; } }
                </style>
            </head>
            <body>
                <div class="kop-container">
                    <div class="kop-left"><img src="${logoUrl}" class="kop-logo" /></div>
                    <div class="kop-right">
                        <div class="kop-title">PEMERINTAH KABUPATEN TAPANULI SELATAN</div>
                        <div class="kop-sub">KECAMATAN ${data.kecamatan}</div>
                        <div class="kop-sub">DESA ${data.desa}</div>
                    </div>
                </div>
                <div class="garis-kop"></div>
                <h2>LAPORAN ABSENSI PERANGKAT DESA<br>${data.tanggal}</h2>
                ${tableContent}
                <div class="ttd-container">
                    <div class="ttd-wrapper">
                        <div class="tanggal">${data.tanggalttd}</div>
                        <div>Mengetahui,</div>
                        <div class="nama">${data.penandatangan}</div>
                    </div>
                </div>
            </body>
            </html>
            `);

            win.document.close();

            let img = win.document.querySelector('.kop-logo');
            if (img) {
                img.onload = () => {
                    win.focus();
                    win.print();
                };
            } else {
                win.focus();
                win.print();
            }
        });
    });
</script>
