<div>
    <!-- Notifikasi Sukses -->
    @if (session()->has('message'))
    <div
        class="mb-6 bg-emerald-50 border border-emerald-200 p-4 rounded-2xl flex items-center shadow-sm animate-pulse-once">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-500 bg-white rounded-full shadow-sm mr-3">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                 viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
        </div>
        <div class="text-sm font-bold text-emerald-800">{{ session('message') }}</div>
    </div>
    @endif

    <!-- FILTER & PENCARIAN (Tema Modern) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
        <div class="flex flex-col lg:flex-row gap-4 items-end justify-between">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full lg:w-1/2">
                <!-- Filter Kecamatan -->
                <div>
                    <label for="kecamatan"
                           class="block mb-1.5 text-xs font-bold text-gray-600 uppercase tracking-wider">
                        Kecamatan
                    </label>
                    <select wire:model.live="kodeKec" id="kecamatan"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-900 focus:ring-emerald-500 focus:border-emerald-500 transition-all font-medium">
                        <option value="">-- Semua Kecamatan --</option>
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
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-900 focus:ring-emerald-500 focus:border-emerald-500 transition-all font-medium">
                        <option value="">-- Semua Desa --</option>
                        @foreach($this->desas as $desa)
                        <option value="{{ $desa->kode_desa }}">{{ $desa->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Pencarian Bebas (Nama/Keterangan) -->
            <div class="w-full lg:w-1/3">
                <label for="search-desa" class="block mb-1.5 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Pencarian
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="search-desa" wire:model.live="search"
                           class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-200 rounded-xl bg-gray-50 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                           placeholder="Ketik nama atau alasan..." autocomplete="off">
                </div>
            </div>

        </div>
    </div>

    <!-- DAFTAR PENGAJUAN IZIN (Tabel) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-emerald-900 uppercase bg-emerald-50 border-b border-gray-100 font-bold">
                <tr>
                    <th scope="col" class="px-6 py-4">Informasi Pegawai</th>
                    <th scope="col" class="px-6 py-4 text-center">Tanggal</th>
                    <th scope="col" class="px-6 py-4 text-center">Alasan Izin</th>
                    <th scope="col" class="px-6 py-4 text-center">Lampiran/Bukti</th>
                    <th scope="col" class="px-6 py-4 text-center w-52">Tindakan Persetujuan</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($this->absensi as $absensi)
                <tr class="hover:bg-emerald-50/30 transition-colors bg-white">

                    <!-- Nama & Jabatan -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-900">{{ $absensi->nama_perangkat }}</span>
                            <span
                                class="text-xs font-medium text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded w-max mt-1 border border-emerald-100">
                                    {{ $absensi->nama_jabatan }}
                                </span>
                        </div>
                    </td>

                    <!-- Tanggal -->
                    <td class="px-6 py-4 text-center text-gray-600 font-medium whitespace-nowrap">
                        {{ $absensi->tanggal->format('d M Y') }}
                    </td>

                    <!-- Jenis/Alasan Izin -->
                    <td class="px-6 py-4 text-center">
                            <span
                                class="inline-block bg-gray-100 text-gray-700 font-semibold px-3 py-1 rounded-lg text-xs border border-gray-200 w-max max-w-xs truncate">
                                {{ $absensi->keterangan }}
                            </span>
                    </td>

                    <!-- Lampiran -->
                    <td class="px-6 py-4 text-center">
                        @if($absensi->lampiran)
                        <a href="{{ asset('storage/' . $absensi->lampiran) }}" target="_blank"
                           class="inline-flex items-center justify-center gap-1 font-bold text-blue-700 hover:text-white bg-blue-50 hover:bg-blue-600 border border-blue-200 hover:border-blue-600 px-3 py-1.5 rounded-lg text-xs transition-colors">
                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01"/>
                            </svg>
                            Buka Dokumen
                        </a>
                        @else
                        <span class="text-gray-400 italic text-xs">Tanpa lampiran</span>
                        @endif
                    </td>

                    <!-- Tombol Aksi (Setujui / Tolak) -->
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        <div class="flex justify-center items-center gap-2">
                            <button wire:click="confirmSetujui({{ $absensi->id }})"
                                    class="inline-flex items-center px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold rounded-lg shadow-sm transition-transform hover:-translate-y-0.5">
                                <svg class="w-3.5 h-3.5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                                </svg>
                                Setujui
                            </button>

                            <button wire:click="confirmTolak({{ $absensi->id }})"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-lg shadow-sm transition-transform hover:-translate-y-0.5">
                                <svg class="w-3.5 h-3.5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                </svg>
                                Tolak
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <p class="text-gray-500 font-medium">Tidak ada data pengajuan izin yang tertunda.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL KONFIRMASI (Desain Halus) -->
    <div wire:ignore.self id="confirmModal"
         class="fixed inset-0 z-50 hidden items-center justify-center bg-emerald-950/60 backdrop-blur-sm transition-opacity"
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="relative w-full max-w-md p-4 h-auto">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100">

                <!-- Tombol Close Silang -->
                <button onclick="closeModalJS()" type="button"
                        class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center transition-colors">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>

                <div class="p-6 text-center pt-10">
                    <!-- Ikon Peringatan -->
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-amber-100 mb-6">
                        <svg class="h-10 w-10 text-amber-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>

                    <h3 class="mb-5 text-lg font-bold text-gray-900 leading-relaxed">
                        {{ $modalMessage }}
                    </h3>

                    <div class="flex justify-center gap-3">
                        <button wire:click="closeModal" type="button"
                                class="py-2.5 px-5 text-sm font-bold text-gray-700 bg-white rounded-xl border border-gray-200 hover:bg-gray-50 hover:text-emerald-700 focus:outline-none focus:ring-4 focus:ring-gray-100 transition-all">
                            Batal
                        </button>
                        <button wire:click="proceedAction" wire:loading.attr="disabled" type="button"
                                class="text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-bold rounded-xl text-sm px-5 py-2.5 text-center shadow-sm transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center">
                            <span wire:loading wire:target="proceedAction" class="mr-2">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10"
                                                                             stroke="currentColor"
                                                                             stroke-width="4"></circle><path
                                        class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </span>
                            Ya, Lanjutkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- SCRIPT LIVEWIRE MODAL EVENT -->
<script>
    function closeModalJS() {
        const modal = document.getElementById('confirmModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.addEventListener('livewire:init', () => {
        const modal = document.getElementById('confirmModal');

        window.addEventListener('open-confirm-modal', (event) => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        window.addEventListener('close-confirm-modal', (event) => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    });
</script>
