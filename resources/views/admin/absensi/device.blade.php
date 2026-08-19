@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Data Verifikasi Absensi</h2>
    </div>

    <!-- Memanggil komponen Livewire -->
    @livewire('verifikasi-device')

</div>
@endsection
