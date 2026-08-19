@extends('admin.dashboard')

@section('title', 'Data Absensi - Sipature Desa')

@section('content')
<div class="w-full">

    <!-- HEADER HALAMAN -->
    <div class="mb-6">
        <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-900 tracking-tight">
            Absensi Aparatur Desa
        </h2>
        <p class="text-gray-500 text-sm mt-1 font-medium">
            Pencatatan kehadiran, keterlambatan, dan rekapitulasi izin harian.
        </p>
    </div>

    <!-- MEMANGGIL KOMPONEN LIVEWIRE -->
    <livewire:absensi-filter/>

</div>
@endsection
