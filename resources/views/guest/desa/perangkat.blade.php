@extends('guest.layouts.app')

@section('content')
<div>

    <img src="{{ asset('images/profile_default.png') }}"
         class="rounded-full w-60 h-60 mx-auto my-4"
         alt="image description">

    <!-- nama perangkat -->
    <div>
        <h2 class="max-w-md mx-auto text-4xl font-bold dark:text-white text-center">{{$perangkat->nama}}</h2>
        <h3 class="max-w-md mx-auto text-2xl font-bold dark:text-white text-center">
            ( {{$perangkat->nama_jabatan}} )
        </h3>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 text-center">
            "Berpegang pada prinsip kejujuran dan keadilan bersosial"
        </p>
    </div>

    <!-- Table absensi -->
    <div class="sm:my-8 md:my-10 lg:my-16 my-4 sm:rounded-lg sm:mx-6 md:mx-10 lg:mx-32 mx-2">
        <h2 class="text-2xl md:text-4xl font-extrabold dark:text-white">Absensi</h2>
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
                @foreach ($perangkat->absensi as $absensi)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-40 px-4 py-4 text-center">
                        {{ \Carbon\Carbon::createFromTimestamp($absensi->tanggal / 1000)->format('d M Y') }}
                    </td>
                    <td class="px-4 py-4 text-center">
                        {{ $absensi->absensi_pagi ? tanggal('H:i', $absensi->absensi_pagi) : '-' }}
                    </td>
                    <td class="px-4 py-4 text-center">
                        {{ $absensi->keterlambatan ? $absensi->keterlambatan . ' menit' : '-' }}
                    </td>
                    <td class="px-4 py-4 text-center">
                        {{ $absensi->absensi_sore ? tanggal('H:i', $absensi->absensi_sore) : '-' }}
                    </td>
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
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
