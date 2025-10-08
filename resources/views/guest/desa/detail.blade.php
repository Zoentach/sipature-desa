@extends('guest.layouts.app')

@section('content')
<div id="default-carousel" class="relative sm:mx-10 md:mx-16 lg:mx-32 m-4" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://flowbite.com/docs/images/logo.svg"
                 class="absolute block w-full -transketerlambatan-x-1/2 -transketerlambatan-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://flowbite.com/docs/images/logo.svg"
                 class="absolute block w-full -transketerlambatan-x-1/2 -transketerlambatan-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://flowbite.com/docs/images/logo.svg"
                 class="absolute block w-full -transketerlambatan-x-1/2 -transketerlambatan-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -transketerlambatan-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
    </div>
    <!-- Slider controls -->
    <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<!-- nama desa -->
<div class="m-4">
    <h2 class="max-w-md mx-auto text-4xl font-bold dark:text-white text-center">
        {{ $desa->nama }}
    </h2>
    <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 text-center">
        Menuju Tapanuli Selatan Yang Lebih Baik
    </p>

    <div class="flex justify-center">
        <a href="{{ route('export.kredensial', ['kode_desa' => $desa->kode_desa]) }}">
            <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300
                           font-medium rounded-lg text-sm px-4 py-2 text-center
                           dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Buat Kredensial
            </button>
        </a>
    </div>
</div>

<!-- card baris pertama -->
<div class="flex flex-col md:flex-row justify-center items-center gap-6">

    <!-- perangkat desa -->

    <div>
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white text-center">
                Perangkat Desa
            </h5>
            <ul class="my-4 space-y-3">
                @foreach ($desa->perangkatDesa->filter(function($item) {
                return in_array($item->grup_jabatan, ['01', '02']);
                }) as $perangkat)
                <li>
                    <a href="{{ route('perangkat.detail', ['id' => $perangkat -> id]) }}"
                       class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <img src="{{ asset('images/profile_default.png') }}" alt="icon" class="h-6 w-6">
                        <div class="flex-1 ms-3 whitespace-nowrap">
                            <div>{{ $perangkat->nama }}</div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                {{ $perangkat->nama_jabatan }}
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded-sm dark:bg-gray-700 dark:text-gray-400">Lihat</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- BPD -->
    <div>
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white text-center">
                Badan Permusyawaratan Desa
            </h5>
            <ul class="my-4 space-y-3">
                <li>
                    <a href="#"
                       class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <img src="{{ asset('images/profile_default.png') }}" alt="icon" class="h-6 w-6">
                        <div class="flex-1 ms-3 whitespace-nowrap">
                            <div>Juniarti Pasaribu</div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">Kepala Desa</div>
                        </div>
                        <span
                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded-sm dark:bg-gray-700 dark:text-gray-400">Lihat</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Kopdes -->
    <div>
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white text-center">
                Karang Taruna
            </h5>
            <ul class="my-4 space-y-3">
                @foreach ($desa->perangkatDesa->filter(function($item) {
                return in_array($item->kode_jabatan, ['PD02', 'PD03']);
                }) as $perangkat)
                <li>
                    <a href="#"
                       class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <img src="{{ asset('images/profile_default.png') }}" alt="icon" class="h-6 w-6">
                        <div class="flex-1 ms-3 whitespace-nowrap">
                            <div>$perangkat->nama</div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">perangkat->kode_jabatan
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded-sm dark:bg-gray-700 dark:text-gray-400">Lihat</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- card baris kedua -->
<div class="flex flex-col md:flex-row justify-center items-center gap-6 my-6">
    <!-- perangkat desa -->
    <div>
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white text-center">
                Koperasi Merah Putih
            </h5>
            <ul class="my-4 space-y-3">
                @foreach ($desa->perangkatDesa->filter(function($item) {
                return in_array($item->grup_jabatan, ['01', '02']);
                }) as $perangkat)
                <li>
                    <a href="#"
                       class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <img src="{{ asset('images/profile_default.png') }}" alt="icon" class="h-6 w-6">
                        <div class="flex-1 ms-3 whitespace-nowrap">
                            <div>{{ $perangkat->nama }}</div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                {{ $perangkat->nama_jabatan }}
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded-sm dark:bg-gray-700 dark:text-gray-400">Lihat</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- BPD -->
    <div>
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white text-center">
                Badan Usaha Milik Desa
            </h5>
            <ul class="my-4 space-y-3">
                <li>
                    <a href="#"
                       class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <img src="{{ asset('images/profile_default.png') }}" alt="icon" class="h-6 w-6">
                        <div class="flex-1 ms-3 whitespace-nowrap">
                            <div>Juniarti Pasaribu</div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">Kepala Desa</div>
                        </div>
                        <span
                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded-sm dark:bg-gray-700 dark:text-gray-400">Lihat</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Kopdes -->
    <div>
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white text-center">
                Pemberdayaan Kesejahteraan Keluarga
            </h5>
            <ul class="my-4 space-y-3">
                @foreach ($desa->perangkatDesa->filter(function($item) {
                return in_array($item->kode_jabatan, ['PD02', 'PD03']);
                }) as $perangkat)
                <li>
                    <a href="#"
                       class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <img src="{{ asset('images/profile_default.png') }}" alt="icon" class="h-6 w-6">
                        <div class="flex-1 ms-3 whitespace-nowrap">
                            <div>$perangkat->nama</div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">perangkat->kode_jabatan
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded-sm dark:bg-gray-700 dark:text-gray-400">Lihat</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Aset Desa -->
<div class="sm:my-8 md:my-10 lg:my-16 my-4 sm:rounded-lg sm:mx-6 md:mx-10 lg:mx-32 mx-2">
    <h2 class="text-2xl md:text-4xl font-extrabold dark:text-white">Daftar Aset</h2>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="w-16 px-4 py-3 text-center">No.</th>
                <th scope="col" class="px-6 py-3 text-center">
                    Nama
                </th>
                <th scope="col" class="w-16 px-4 px-6 py-3 text-center">
                    Jumlah
                </th>
                <th scope="col" class="w-24 px-4 py-3 text-center">
                    Satuan
                </th>
                <th scope="col" class="w-24 px-4 py-3 text-center">
                    Tahun Pengadaan
                </th>
                <th scope="col" class="w-24 px-4 py-3 text-center">
                    Dokumentasi
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 text-center">
                    1
                </td>
                <th scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4 text-center">
                    100
                </td>
                <td class="px-6 py-4 text-center">
                    Buah
                </td>
                <td class="px-6 py-4 text-center">
                    2025
                </td>
                <td class="w-24 px-4 py-3 text-center">
                    <a href=""
                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
