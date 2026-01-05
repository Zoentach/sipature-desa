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

    </div>
    <!-- Daftar Absensi -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="w-20  px-4 py-3 text-center">No</th>
                <th scope="col" class="px-4 py-4 text-center">NIP</th>
                <th scope="col" class="px-4 text-center">NAMA</th>
                <th scope="col" class="px-4 text-center">PANGKAT/GOL</th>
                <th scope="col" class="px-4 text-center">JABATAN</th>
            </tr>
            </thead>
            <tbody>
            @forelse($this->pegawais as $pegawai)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-20 px-4 py-4 text-center">
                    {{ $loop->iteration }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $pegawai->nip}}
                </td>

                <td class="px-4 py-4 text-center">
                    {{ $pegawai->nama }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $pegawai->golongan }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $pegawai->jabatan }}
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




