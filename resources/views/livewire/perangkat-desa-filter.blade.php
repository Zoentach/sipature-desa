<div>
    <!-- Header: Filter & Tombol Aksi -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <!-- Bagian Filter (Kecamatan & Desa) -->
        <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
            <!-- (Kode Filter Kecamatan & Desa tetap sama seperti milik Anda) -->
            <select wire:model.live="kodeKec"
                    class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Kecamatan --</option>
                @foreach($this->kecamatans as $kec)
                <option value="{{ $kec->kode_kecamatan }}">{{ $kec->nama }}</option>
                @endforeach
            </select>

            <select wire:model.live="kodeDesa"
                    class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    @if(!$kodeKec) disabled @endif>
                <option value="">-- Pilih Desa --</option>
                @if($kodeKec)
                @foreach($this->desas as $desa)
                <option value="{{ $desa->kode_desa }}">{{ $desa->nama }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <!-- Bagian Tombol Tambah & Import -->
        <div class="flex gap-2">
            <!-- PERBAIKAN: Link ke route create -->
            <a href="{{ route('perangkat_desa.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm text-sm font-medium">
                + Tambah
            </a>
            <a href="{{ route('perangkat_desa.import') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow-sm text-sm font-medium">
                Import
            </a>
        </div>
    </div>

    @if($kodeKec && $kodeDesa)
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    No
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    NIPD
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    NIK
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Jabatan
                </th>
                <!-- PERBAIKAN: Tambah Kolom Status -->
                <th scope="col"
                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                </th>
                <th scope="col"
                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse($this->perangkats as $index => $perangkat)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $perangkat->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $perangkat->nipd ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $perangkat->nik ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $perangkat->nama_jabatan }}</td>

                <!-- PERBAIKAN: Menampilkan badge Status -->
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                    @if($perangkat->status_keaktifan == 'Aktif')
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $perangkat->status_keaktifan }}
                        </span>
                    @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            {{ $perangkat->status_keaktifan ?? 'Tidak Diketahui' }}
                        </span>
                    @endif
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <!-- PERBAIKAN: Link ke route edit -->
                    <a href="{{ route('perangkat_desa.edit', $perangkat->id) }}"
                       class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold rounded shadow-sm">
                        Ubah
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                    Tidak ada data Perangkat Desa untuk desa ini.
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @else
    <!-- Pesan Informatif (Tetap sama) -->
    @endif
</div>
