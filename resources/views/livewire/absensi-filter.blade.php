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
                <option value=" {{ $desa->kode_desa }}">{{ $desa->nama}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tanggal" class="block mb-1 font-semibold text-gray-700 dark:text-white"> Dari </label> <input
                type="tanggal" wire:model.live="fromtanggal" id="tanggal" class="border rounded px-3 py-2"/>
        </div>
        <div>
            <label for="tanggal" class="block mb-1 font-semibold text-gray-700 dark:text-white"> Sampai </label> <input
                type="tanggal" wire:model.live="totanggal" id="tanggal" class="border rounded px-3 py-2"/>
        </div>
    </div>
    <!-- Daftar Absensi -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="w-40 px-4 py-3 text-center">Tanggal</th>
                <th scope="col" class="px-4 py-3 text-center">Pagi</th>
                <th scope="col" class="px-4 py-3 text-center">Terlambat</th>
                <th scope="col" class="px-4 py-3 text-center">Sore</th>
                <th scope="col" class="px-4 py-3 text-center">Pulang Cepat</th>
                <th scope="col" class="px-4 py-3 text-center">Gambar Pagi</th>
                <th scope="col" class="px-4 py-3 text-center">Gambar Sore</th>
            </tr>
            </thead>
            <tbody>
            @forelse($this->absensi as $attendance)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-40 px-4 py-4 text-center">
                    {{ \Carbon\Carbon::createFromTimestamp($attendance->tanggal / 1000)->format('d M Y') }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $attendance->absensi_pagi ? tanggal('H:i', $attendance->absensi_pagi) : '-' }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $attendance->keterlambatan ? $attendance->keterlambatan . ' menit' : '-' }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $attendance->absensi_sore ? tanggal('H:i', $attendance->absensi_sore) : '-' }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $attendance->pulang_cepat ? $attendance->pulang_cepat . ' menit' : '-' }}
                </td>
                <td class="px-4 py-4 text-center">
                    @if($attendance->gambar_pagi)
                    <a href="{{ asset('storage/' . $attendance->gambar_pagi) }}" target="_blank"
                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                    @else
                    <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="px-4 py-4 text-center">
                    @if($attendance->gambar_sore)
                    <a href="{{ asset('storage/' . $attendance->gambar_sore) }}" target="_blank"
                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                    @else
                    <span class="text-gray-400">-</span>
                    @endif
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

