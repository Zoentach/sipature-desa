@extends('admin.dashboard')

@section('content')

{{-- Header --}}
<div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Daftar Regulasi & Produk Hukum
    </h1>
    <p class="text-sm text-gray-500">
        Pencarian regulasi berdasarkan nomor, judul, jenis, atau unit kerja
    </p>

    <a href="{{ route('regulasi.tambah') }}"
       class="inline-flex items-center px-4 py-2 text-sm font-medium
          text-white bg-blue-600 rounded-lg
          hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
        + Tambah
    </a>
</div>


<livewire:regulasi-filter/>

@endsection
