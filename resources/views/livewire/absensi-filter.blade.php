<div>
    <!-- Filter -->
    <div class="mb-6 flex flex-wrap gap-4 items-end">
        <div>
            <label for="kecamatan" class="block mb-1 font-semibold text-gray-700 dark:text-white">
                Kecamatan
            </label>
            <select wire:model.live="kodeKec" id="kecamatan" class="border rounded px-3 py-2">
                <option value="">-- Pilih Kecamatan --</option>
                @foreach($this->kecamatans as $kecamatan)
                <option value="{{ $kecamatan->kode_kecamatan }}">{{ $kecamatan->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="desa" class="block mb-1 font-semibold text-gray-700 dark:text-white">
                Desa
            </label>
            <select wire:model.live="kodeDesa" id="desa" class="border rounded px-3 py-2">
                <option value="">-- Pilih Desa --</option>
                @foreach($this->desas as $desa)
                <option value="{{ $desa->kode_desa }}">{{ $desa->nama}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="fromDate" class="block mb-1 font-semibold text-gray-700 dark:text-white">
                Dari
            </label>
            <input
                type="date"
                wire:model.live="fromDate"
                id="fromDate"
                class="border rounded px-3 py-2"
            />
        </div>

        <div>
            <label for="toDate" class="block mb-1 font-semibold text-gray-700 dark:text-white">
                Sampai
            </label>
            <input
                type="date"
                wire:model.live="toDate"
                id="toDate"
                class="border rounded px-3 py-2"
            />
        </div>

        <div>
            <button type="button"
                    wire:click="prints"
                    class="inline-flex items-center gap-2 text-white
           bg-blue-600 hover:bg-blue-700
           focus:ring-4 focus:ring-blue-300
           font-medium text-sm px-4 py-2.5
           rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M6 9V4h12v5m-2 10H8v-4h8v4Zm3-4h1a1 1 0 0 0 1-1v-4a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v4a1 1 0 0 0 1 1h1"/>
                </svg>
                Cetak
            </button>
        </div>
        <div>
            <button type="button"
                    onclick="window.location='{{ route('absensi.izin') }}'"
                    class="inline-flex items-center gap-2 text-white bg-blue-600 hover:bg-blue-700
               focus:ring-4 focus:ring-blue-300 font-medium text-sm px-4 py-2.5 rounded">
                Pengajuan Izin
                <span class="inline-flex items-center justify-center w-5 h-5
                 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
       {{ $this -> izins}}
    </span>
            </button>
        </div>

    </div>
    <!-- Daftar Absensi -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3 text-center">Nama</th>
                <th scope="col" class="px-4 py-3 text-center">Tanggal</th>
                <!--   <th scope="col" class="px-4 py-3 text-center">Pagi</th> -->
                <th scope="col" class="w-40 px-4 py-3 text-center">Terlambat</th>
                <!--  <th scope="col" class="px-4 py-3 text-center">Sore</th> -->
                <th scope="col" class="w-40 px-4 py-3 text-center">Pulang Cepat</th>
                <th scope="col" class="w-40 px-4 py-3 text-center">Gambar Pagi</th>
                <th scope="col" class="w-40 px-4 py-3 text-center">Gambar Sore</th>
                <th scope="col" class="w-40 px-4 py-3 text-center">Keterangan</th>
            </tr>
            </thead>
            <tbody>
            @forelse($this->absensi as $absensi)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-40 px-4 py-4 text-center">
                    {{ $absensi->nama_perangkat }}
                </td>
                <td class="w-40 px-4 py-4 text-center">
                    {{ $absensi->tanggal->format('d M Y') }}
                </td>
                <!--                <td class="px-4 py-4 text-center">
                                 {{ $absensi->absensi_pagi ? tanggal('H:i', $absensi->absensi_pagi) : '-' }}
                           </td> -->
                <td class="px-4 py-4 text-center">
                    {{ $absensi->keterlambatan ? $absensi->keterlambatan . ' menit' : '-' }}
                </td>
                <!--              <td class="px-4 py-4 text-center">
               //                    {{ $absensi->absensi_sore ? tanggal('H:i', $absensi->absensi_sore) : '-' }}
               //                </td> -->
                <td class="px-4 py-4 text-center">
                    {{ $absensi->pulang_cepat ? $absensi->pulang_cepat . ' menit' : '-' }}
                </td>
                <td class="px-4 py-4 text-center">
                    @if($absensi->gambar_pagi)
                    <a href="{{ asset('storage/' . $absensi->gambar_pagi) }}" target="_blank"
                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                    @else
                    <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="px-4 py-4 text-center">
                    @if($absensi->gambar_sore)
                    <a href="{{ asset('storage/' . $absensi->gambar_sore) }}" target="_blank"
                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                    @else
                    <span class="text-gray-400">-</span>
                    @endif
                </td>
                @php
                $statusColor = [
                'Ditolak' => 'text-red-600 font-semibold',
                'Pending' => 'text-yellow-600 font-semibold',
                'Disetujui' => 'text-green-600 font-semibold',
                ];
                @endphp

                <td class="w-40 px-4 py-4 text-center {{ $statusColor[$absensi->status_kehadiran] ?? '' }}">
                    {{ $absensi->keterangan }}
                </td>
            </tr>
            @empty
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td colspan="7" class="px-auto py-4 text-center align-middle">Tidak ada data</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

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
                body {
                    font-family: "Times New Roman", serif;
                    margin:40px;
                }

                .kop-container {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.kop-left {
    width: 90px;
}

.kop-logo {
    width: 90px;
    height: auto;
}

.kop-right {
    flex: 1;
    text-align: center;
    margin-left: -90px; /* agar teks benar-benar berada di tengah */
}

.kop-title {
    font-size: 20px;
    font-weight: bold;
    text-transform: uppercase;
}

.kop-sub {
    font-size: 16px;
    text-transform: uppercase;
}


                .garis-kop {
                    border-top:3px solid #000;
                    border-bottom:1px solid #000;
                    margin-top:10px;
                    margin-bottom:30px;
                    padding:2px 0;
                }

                h2 {
                    text-align:center;
                    text-transform:uppercase;
                    margin:20px 0;
                }

                table {
                    width:100%;
                    border-collapse:collapse;
                }

                table, th, td {
                    border:1px solid #000;
                }

                th, td {
                    padding:8px;
                    text-align:center;
                }

              .ttd-container {
    width: 100%;
    margin-top: 40px;
    text-align: right; /* posisi blok di kanan */
}

.ttd-wrapper {
    display: inline-block;
    text-align: left; /* isi di dalamnya rata kiri */
    font-size: 14px;
    line-height: 1.4;
}

.ttd-wrapper .tanggal {
    margin-bottom: 5px;
}

.ttd-wrapper .nama {
    margin-top: 60px;
    font-weight: bold;
    text-decoration: underline;
}



                @media print {
                    @page { size:A4; margin:20mm; }
                }
            </style>
        </head>

        <body>

          <div class="kop-container">
    <div class="kop-left">
        <img src="${logoUrl}" class="kop-logo" />
    </div>

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

            // TUNGGU LOGO SELESAI LOADING
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




