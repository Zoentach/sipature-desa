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
</div>

<livewire:regulasi-filter/>

@endsection
