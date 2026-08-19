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

    <!-- Area Filter & Pencarian (Tema Modern) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">

            <!-- Judul Mini -->
            <div class="w-full md:w-auto">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Penyaringan Data</h3>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <!-- Dropdown Filter Kecamatan -->
                <select wire:model.live="kodeKec"
                        class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:min-w-[200px] p-2.5 transition-all font-medium">
                    <option value="">-- Semua Kecamatan --</option>
                    @foreach($this->kecamatans as $kec)
                    <option value="{{ $kec->kode_kecamatan }}">{{ $kec->nama }}</option>
                    @endforeach
                </select>

                <!-- Input Box Pencarian -->
                <div class="relative w-full sm:min-w-[300px]">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search"
                           class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full pl-10 p-2.5 transition-all"
                           placeholder="Cari nama aparatur atau desa...">
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Verifikasi -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-emerald-900 uppercase bg-emerald-50 border-b border-gray-100 font-bold">
                <tr>
                    <th scope="col" class="px-6 py-4">No</th>
                    <th scope="col" class="px-6 py-4">User (Aparatur)</th>
                    <th scope="col" class="px-6 py-4">Desa</th>
                    <th scope="col" class="px-6 py-4">MAC Address</th>
                    <th scope="col" class="px-6 py-4">Koordinat Lokasi</th>
                    <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($this->verifikasis as $index => $item)
                <tr class="hover:bg-emerald-50/30 transition-colors bg-white">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col">
                            <span
                                class="text-sm font-bold text-gray-900">{{ $item->user->name ?? 'Tidak Diketahui' }}</span>
                            <span class="text-xs text-gray-400 font-medium">ID: {{ $item->user_id }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-emerald-700">
                        {{ $item->desa->nama ?? $item->kode_desa }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="bg-gray-100 text-gray-700 text-xs font-mono px-2 py-1 rounded-md border border-gray-200">
                                {{ $item->mac_address ?? 'Belum terdaftar' }}
                            </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col gap-1">
                                <span
                                    class="text-xs font-medium text-gray-600 bg-gray-50 px-2 py-0.5 rounded w-max border border-gray-100">
                                    Lat: {{ $item->latitude ?? '-' }}
                                </span>
                            <span
                                class="text-xs font-medium text-gray-600 bg-gray-50 px-2 py-0.5 rounded w-max border border-gray-100">
                                    Lng: {{ $item->longitude ?? '-' }}
                                </span>
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex justify-center items-center gap-2">
                            <!-- Tombol Ubah (Emas) -->
                            <a href="{{ route('device.edit', $item->id) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-amber-100 text-amber-700 hover:bg-amber-500 hover:text-white text-xs font-bold rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/>
                                </svg>
                                Ubah
                            </a>

                            <!-- Tombol Hapus (Merah) -->
                            <button wire:click="confirmDelete({{ $item->id }})"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white text-xs font-bold rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 font-medium">
                                @if($search)
                                Tidak ada perangkat yang cocok dengan kata kunci <span class="font-bold text-gray-700">"{{ $search }}"</span>.
                                @else
                                Belum ada data verifikasi perangkat yang didaftarkan.
                                @endif
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus (Desain Halus) -->
    @if($isModalOpen)
    <div
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-emerald-950/60 backdrop-blur-sm transition-opacity">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100">
                <!-- Tombol Tutup Modal (X) -->
                <button wire:click="closeModal" type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>

                <div class="p-6 text-center pt-10">
                    <!-- Ikon Peringatan -->
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                        <svg class="h-10 w-10 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-gray-900">Hapus Perangkat?</h3>
                    <p class="mb-6 text-sm text-gray-500 font-medium leading-relaxed">
                        Perangkat ini tidak akan bisa digunakan lagi untuk melakukan absensi. Tindakan ini tidak dapat
                        dibatalkan.
                    </p>

                    <div class="flex justify-center gap-3">
                        <button wire:click="closeModal" type="button"
                                class="py-2.5 px-5 text-sm font-bold text-gray-700 focus:outline-none bg-white rounded-xl border border-gray-200 hover:bg-gray-50 hover:text-emerald-700 focus:z-10 focus:ring-4 focus:ring-gray-100 transition-all">
                            Batal
                        </button>
                        <button wire:click="delete" type="button"
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-xl text-sm px-5 py-2.5 text-center shadow-sm transition-all hover:-translate-y-0.5">
                            Ya, Hapus Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
