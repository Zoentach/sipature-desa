@extends('admin.dashboard')

@section('title', 'Data Pengajuan Izin - Sipature Desa')

@section('content')
<div class="w-full">

    <!-- HEADER HALAMAN -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-900 tracking-tight">
                Daftar Pengajuan Izin
            </h2>
            <p class="text-gray-500 text-sm mt-1 font-medium">
                Persetujuan dan penolakan izin ketidakhadiran aparatur desa.
            </p>
        </div>

        <!-- Tombol Kembali ke Absensi (Opsional) -->
        <div>
            <a href="{{ route('absensi.index') }}"
               class="inline-flex items-center gap-2 text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 focus:ring-4 focus:ring-emerald-200 font-bold text-sm px-5 py-2.5 rounded-xl transition-all">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
                Kembali ke Data Absensi
            </a>
        </div>
    </div>

    <!-- Memanggil komponen Livewire -->
    <livewire:izin-filter/>

</div>
@endsection
