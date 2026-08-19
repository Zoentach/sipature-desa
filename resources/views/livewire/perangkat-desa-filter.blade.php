<div>
    <!-- FILTER & TOMBOL AKSI (Tema Modern) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
        <div class="flex flex-col lg:flex-row justify-between items-center gap-4">

            <!-- Bagian Filter (Kecamatan & Desa) -->
            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                <!-- Dropdown Kecamatan -->
                <div class="w-full sm:w-64">
                    <label class="block mb-1.5 text-xs font-bold text-gray-600 uppercase tracking-wider">
                        Kecamatan
                    </label>
                    <select wire:model.live="kodeKec"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-2.5 transition-all font-medium">
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach($this->kecamatans as $kec)
                        <option value="{{ $kec->kode_kecamatan }}">{{ $kec->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dropdown Desa -->
                <div class="w-full sm:w-64">
                    <label class="block mb-1.5 text-xs font-bold text-gray-600 uppercase tracking-wider">
                        Desa
                    </label>
                    <select wire:model.live="kodeDesa"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-2.5 transition-all font-medium disabled:opacity-50 disabled:bg-gray-100 disabled:cursor-not-allowed"
                            @if(!$kodeKec) disabled @endif>
                        <option value="">-- Pilih Desa --</option>
                        @if($kodeKec)
                        @foreach($this->desas as $desa)
                        <option value="{{ $desa->kode_desa }}">{{ $desa->nama }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <!-- Bagian Tombol Tambah & Import -->
            <div class="flex flex-wrap sm:flex-nowrap gap-3 w-full lg:w-auto lg:pt-5">
                <!-- Tombol Import -->
                <a href="{{ route('perangkat_desa.import') }}"
                   class="inline-flex flex-1 sm:flex-none justify-center items-center gap-2 text-emerald-700 bg-emerald-50 hover:bg-emerald-100 focus:ring-4 focus:ring-emerald-200 border border-emerald-200 font-bold text-sm px-5 py-2.5 rounded-xl shadow-sm transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01"/>
                    </svg>
                    Import Data
                </a>

                <!-- Tombol Tambah -->
                <a href="{{ route('perangkat_desa.create') }}"
                   class="inline-flex flex-1 sm:flex-none justify-center items-center gap-2 text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-200 font-bold text-sm px-5 py-2.5 rounded-xl shadow-md transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                              d="M5 12h14m-7 7V5"/>
                    </svg>
                    Tambah Data
                </a>
            </div>

        </div>
    </div>

    <!-- AREA DATA (Tabel / Info) -->
    @if($kodeKec && $kodeDesa)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-emerald-900 uppercase bg-emerald-50 border-b border-gray-100 font-bold">
                <tr>
                    <th scope="col" class="px-6 py-4">No</th>
                    <th scope="col" class="px-6 py-4">Nama Perangkat</th>
                    <th scope="col" class="px-6 py-4">NIPD</th>
                    <th scope="col" class="px-6 py-4">NIK</th>
                    <th scope="col" class="px-6 py-4">Jabatan</th>
                    <th scope="col" class="px-6 py-4 text-center">Status</th>
                    <th scope="col" class="px-6 py-4 text-center w-28">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($this->perangkats as $index => $perangkat)
                <tr class="hover:bg-emerald-50/30 transition-colors bg-white">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                        {{ $perangkat->nama }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-mono text-gray-600">
                        {{ $perangkat->nipd ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-mono text-gray-600">
                        {{ $perangkat->nik ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-emerald-700">
                        {{ $perangkat->nama_jabatan }}
                    </td>

                    <!-- Badge Status Aktif/Tidak Aktif -->
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($perangkat->status_keaktifan == 'Aktif')
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        {{ $perangkat->status_keaktifan }}
                                    </span>
                        @else
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-lg bg-red-50 text-red-700 border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        {{ $perangkat->status_keaktifan ?? 'Tidak Diketahui' }}
                                    </span>
                        @endif
                    </td>

                    <!-- Tombol Aksi (Ubah) -->
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <a href="{{ route('perangkat_desa.edit', $perangkat->id) }}"
                           class="inline-flex items-center justify-center px-3 py-1.5 bg-amber-100 text-amber-700 hover:bg-amber-500 hover:text-white text-xs font-bold rounded-lg transition-colors shadow-sm">
                            <svg class="w-3.5 h-3.5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/>
                            </svg>
                            Ubah
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-500 font-medium">Belum ada data Perangkat Desa di desa ini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @else
    <!-- Pesan Informatif jika Kecamatan & Desa belum dipilih -->
    <div
        class="bg-gray-50 border border-gray-200 border-dashed rounded-2xl p-10 flex flex-col items-center justify-center text-center">
        <div class="bg-white p-4 rounded-full shadow-sm mb-4 border border-gray-100">
            <svg class="w-10 h-10 text-emerald-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.949 8.949 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-1">Silakan Pilih Area</h3>
        <p class="text-gray-500 text-sm max-w-sm">Pilih <b>Kecamatan</b> dan <b>Desa</b> terlebih dahulu pada kolom
            filter di atas untuk melihat daftar Perangkat Desa.</p>
    </div>
    @endif
</div>
