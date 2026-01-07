<div class="p-6 space-y-6">

   
    {{-- Search --}}
    <div class="bg-white rounded-lg shadow p-4">
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Cari Regulasi
        </label>
        <input
            type="text"
            wire:model.live="search"
            placeholder="Ketik nomor, judul, jenis regulasi, atau unit kerja..."
            class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
        >
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Jenis Regulasi</th>
                <th class="px-4 py-3">Nomor / Tahun</th>
                <th class="px-4 py-3">Tentang</th>
                <th class="px-4 py-3">Unit Kerja</th>
                <th class="px-4 py-3 text-center">Dokumen</th>
            </tr>
            </thead>
            <tbody>

            @forelse ($this->daftarRegulasi as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3">
                    {{ $loop->iteration }}
                </td>
                <td class="px-4 py-3 font-medium text-gray-800">
                    {{ $item->jenisRegulasi->nama_regulasi }}
                </td>
                <td class="px-4 py-3">
                    {{ $item->nomor_regulasi }} / {{ $item->tahun }}
                </td>
                <td class="px-4 py-3">
                    {{ $item->tentang }}
                </td>
                <td class="px-4 py-3">
                    {{ $item->unitKerja->nama_unit }}
                </td>
                <td class="px-4 py-3 text-center">
                    <a href="{{ asset('storage/'.$item->file_dokumen) }}"
                       target="_blank"
                       class="inline-flex items-center gap-1 text-blue-600 hover:underline">
                        📄 Lihat
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                    Data regulasi tidak ditemukan
                </td>
            </tr>
            @endforelse

            </tbody>
        </table>
    </div>

</div>
