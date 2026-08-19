@extends('admin.dashboard')

@section('title', 'Data Perangkat Desa - Sipature Desa')

@section('content')
<div class="w-full">

    <!-- HEADER HALAMAN -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-900 tracking-tight">
                Daftar Perangkat Desa
            </h2>
            <p class="text-gray-500 text-sm mt-1 font-medium">
                Kelola data aparatur dan perangkat desa di seluruh kecamatan.
            </p>
        </div>
    </div>

    <!-- MEMANGGIL KOMPONEN LIVEWIRE -->
    <livewire:perangkat-desa-filter/>

</div>
@endsection
