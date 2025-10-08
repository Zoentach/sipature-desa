@extends('guest.layouts.app')

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg sm:m-8 md:m-16 lg:mx-72 m-2">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="w-16 px-4 py-3 text-center">No.</th>
            <th scope="col" class="px-6 py-3 text-center">Nama</th>
            <th scope="col" class="px-6 py-3 text-center">Kepala Desa</th>
            <th scope="col" class="w-24 px-4 py-3 text-center">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($desas as $index => $desa)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th scope="row"
                class="w-16 px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                {{ $index + 1 }}
            </th>
            <td class="px-6 py-4 text-center">
                {{ $desa->nama }}
            </td>
            <td class="px-6 py-4 text-center">
                {{ $desa->kepalaDesa->nama ?? '-' }}
            </td>
            <td class="w-24 px-4 py-3 text-center">
                <a href="{{ route('desa.detail', ['id' => $desa -> id]) }}"
                   class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
