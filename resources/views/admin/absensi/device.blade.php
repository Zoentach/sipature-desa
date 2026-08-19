@extends('admin.dashboard')

@section('title', 'Verifikasi Perangkat - Sipature Desa')

@section('content')
<div class="w-full">

    <!-- HEADER HALAMAN -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-900 tracking-tight">
                Data Verifikasi Perangkat (Device)
            </h2>
            <p class="text-gray-500 text-sm mt-1 font-medium">
                Kelola data perangkat aparatur desa yang diizinkan untuk melakukan absensi.
            </p>
        </div>
    </div>

    <!-- Memanggil komponen Livewire -->
    <livewire:verifikasi-device/>

</div>
@endsection
