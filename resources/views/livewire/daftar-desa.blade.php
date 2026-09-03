<div>
    <!-- Notifikasi Sukses -->
    @if (session()->has('message'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 p-4 rounded-2xl flex items-center shadow-sm">
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

    <!-- Area Filter & Pencarian -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="w-full md:w-auto">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Penyaringan Data Desa</h3>
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
                           placeholder="Cari nama desa atau kode desa...">
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Desa -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-emerald-900 uppercase bg-emerald-50 border-b border-gray-100 font-bold">
                <tr>
                    <th scope="col" class="px-6 py-4">No</th>
                    <th scope="col" class="px-6 py-4">Nama Desa</th>
                    <th scope="col" class="px-6 py-4">Kecamatan</th>
                    <th scope="col" class="px-6 py-4">Tahun Berdiri</th>
                    <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($this->desas as $index => $item)
                <tr class="hover:bg-emerald-50/30 transition-colors bg-white">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $this->desas->firstItem() + $index }}
                    </td>

                    <!-- Kolom Nama Desa (bawahnya Kode Desa) -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-900">{{ $item->nama }}</span>
                            <span class="text-xs text-gray-400 font-mono mt-0.5">Kode: {{ $item->kode_desa }}</span>
                        </div>
                    </td>

                    <!-- Kolom Nama Kecamatan (bawahnya Kode Kecamatan) -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-emerald-700">{{ $item->kecamatan->nama ?? 'Tidak Diketahui' }}</span>
                            <span
                                class="text-xs text-gray-400 font-mono mt-0.5">Kode: {{ $item->kode_kecamatan }}</span>
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                        {{ $item->tahun_berdiri ?? '-' }}
                    </td>

                    <!-- Kolom Aksi -->
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex justify-center items-center gap-2">
                            <!-- PERBAIKAN: Mengirim ID saja agar lebih aman dari karakter kutip/special -->
                            <button wire:click="showFotoKantor({{ $item->id }})"
                                    class="inline-flex items-center px-3 py-1.5 bg-emerald-100 text-emerald-700 hover:bg-emerald-600 hover:text-white text-xs font-bold rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M21 12c-2.4 4-5.4 6-9 6s-6.6-2-9-6c2.4-4 5.4-6 9-6s6.6 2 9 6Z"/>
                                </svg>
                                Lihat
                            </button>

                            <!-- Tombol Ubah -->
                            <a href="{{ route('desa.admin.edit', $item->id) }}"
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
                                      d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 font-medium">
                                @if($search)
                                Tidak ada desa yang cocok dengan kata kunci <span class="font-bold text-gray-700">"{{ $search }}"</span>.
                                @else
                                Belum ada data desa yang tersedia.
                                @endif
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($this->desas->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $this->desas->links() }}
        </div>
        @endif
    </div>

    <!-- Modal Lihat Foto Kantor -->
    @if($isModalOpen)
    <div
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-emerald-950/60 backdrop-blur-sm transition-opacity">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
                <!-- Header Modal -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-base font-bold text-gray-900">Foto Kantor Desa: <span class="text-emerald-700">{{ $selectedDesaName }}</span>
                    </h3>
                    <button wire:click="closeModal" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center transition-colors">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>

                <!-- Konten Gambar -->
                <div class="p-6 text-center">
                    @if($selectedFotoUrl)
                    <img src="{{ $selectedFotoUrl }}" alt="Foto Kantor Desa"
                         class="w-full h-auto max-h-[400px] object-cover rounded-xl shadow-md border border-gray-100">
                    @else
                    <div
                        class="py-10 bg-gray-50 rounded-xl border border-dashed border-gray-200 flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm font-medium text-gray-500">Desa ini belum memiliki foto kantor.</p>
                    </div>
                    @endif
                </div>

                <!-- Footer Modal -->
                <div class="flex justify-end px-6 py-3 bg-gray-50 border-t border-gray-100">
                    <button wire:click="closeModal" type="button"
                            class="py-2 px-4 text-sm font-bold text-gray-700 bg-white rounded-xl border border-gray-200 hover:bg-gray-100 transition-all">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
