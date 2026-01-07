@extends('guest.layouts.app')

@section('content')

<div>


    <!-- Daftar Pegawai -->
    <div class="max-w-6xl mx-auto relative overflow-x-auto shadow-md sm:rounded-lg my-8">
        <h2 class="text-xl md:text-2xl font-bold mx-6 my-4">
            Monitoring SPT
        </h2>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 px-6 my-4">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="w-20  px-4 py-3 text-center">No</th>
                <th scope="col" class="px-4 text-center">Nama</th>
                <th scope="col" class="px-4 text-center">Bulanan (%)</th>
                <th scope="col" class="px-4 text-center">Dalam Daerah <br> Tahun 2026</th>
                <th scope="col" class="px-4 text-center">Luar Daerah <br> Tahun 2026</th>
                <th scope="col" class="px-4 text-center">Total</th>
            </tr>
            </thead>
            <tbody>
            @forelse($pegawais as $pegawai)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-20 px-4 py-4 text-center">
                    {{ $loop->iteration }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $pegawai->nama}}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $pegawai->persenan}} %
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $pegawai->dalam_daerah }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $pegawai->luar_daerah }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $pegawai->total_perjalanan }}
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
@endsection
