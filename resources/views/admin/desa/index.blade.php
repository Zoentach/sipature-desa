@extends('admin.dashboard')

@section('title', 'Data Desa - Sipature Desa')

@section('content')
<div class="w-full">

    <!-- HEADER HALAMAN -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-900 tracking-tight">
                Data Wilayah Desa
            </h2>
            <p class="text-gray-500 text-sm mt-1 font-medium">
                Kelola daftar desa, informasi kantor, serta data wilayah kecamatan.
            </p>
        </div>
    </div>

    <!-- Memanggil komponen Livewire -->
    <livewire:daftar-desa/>

</div>
@endsection
