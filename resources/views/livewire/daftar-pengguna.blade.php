<div>
    <!-- Filter -->
    <div class="mb-6 flex flex-wrap gap-4 items-end">
        <div>
            <form class="mx-auto" autocomplete="off">
                <label for="default-search"
                       class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Pencarian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search"
                           id="search-desa"
                           wire:model.live="search"
                           class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Ketik nama" required/>
                    <ul id="search-results"
                        class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 hidden">
                    </ul>
                </div>
            </form>

        </div>
        <div>
            <button type="button"
                    onclick="window.location='{{ route('pengguna.tambah') }}'"
                    class="inline-flex items-center gap-2 text-white
           bg-blue-600 hover:bg-blue-700
           focus:ring-4 focus:ring-blue-300
           font-medium text-sm px-4 py-2.5
           rounded-lg shadow-sm transition">

                <svg class="w-4 h-4" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4v16m8-8H4"/>
                </svg>

                Tambah Akun
            </button>
        </div>

    </div>
    <!-- Daftar Pengguna -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3 text-center">Nama</th>
                <th scope="col" class="px-4 py-3 text-center">Email</th>
                <!--   <th scope="col" class="px-4 py-3 text-center">Pagi</th> -->
                <th scope="col" class="w-40 px-4 py-3 text-center">Peran</th>
                <!--  <th scope="col" class="px-4 py-3 text-center">Sore</th> -->
                <th scope="col" class="w-40 px-4 py-3 text-center">Status</th>
                <th scope="col" class="w-40 px-4 py-3 text-center">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse($this->daftarPengguna as $pengguna)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-40 px-4 py-4 text-center">
                    {{ $pengguna->name }}
                </td>
                <td class="w-40 px-4 py-4 text-center">
                    {{ $pengguna->email }}
                </td>
                <td class="w-40 px-4 py-4 text-center">
                    Admin
                </td>
                <td class="px-4 py-4 text-center">
                    Aktif
                </td>
                <td class="px-4 py-4 text-center">
                    <!-- <button
                         wire:click="confirmSetujui({{ $pengguna->id }})"
                         class="px-3 py-1 text-white bg-green-600 hover:bg-green-700 rounded ml-2">
                         Edit
                     </button> -->

                    <button
                        wire:click="confirmTolak({{ $pengguna->id }})"
                        class="px-3 py-1 text-white bg-red-600 hover:bg-red-700 rounded ml-2">
                        Hapus
                    </button>
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

    <!-- Modal Konfirmasi -->
    <div
        wire:ignore.self
        id="confirmModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        <div class="relative w-full max-w-md p-4 h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                <button
                    onclick="closeModalJS()"
                    type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>

                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        {{ $modalMessage }}
                    </h3>

                    <button
                        wire:click="proceedAction"
                        wire:loading.attr="disabled"
                        class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading wire:target="proceedAction" class="mr-2">...</span>
                        Ya, Lanjutkan
                    </button>

                    <button
                        wire:click="closeModal"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Fungsi Helper Vanilla JS untuk menutup modal (dipakai tombol X)
    function closeModalJS() {
        const modal = document.getElementById('confirmModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');

        // Opsional: Dispatch event ke Livewire agar properti state bersih
        // Livewire.dispatch('close-confirm-modal');
    }

    document.addEventListener('livewire:init', () => {
        const modal = document.getElementById('confirmModal');

        // 1. Dengarkan event 'open-confirm-modal' dari PHP
        window.addEventListener('open-confirm-modal', (event) => {
            // Hapus class 'hidden', tambah class 'flex' agar muncul ditengah
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        // 2. Dengarkan event 'close-confirm-modal' dari PHP
        window.addEventListener('close-confirm-modal', (event) => {
            // Balikkan ke kondisi semula (sembunyi)
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    });
</script>






