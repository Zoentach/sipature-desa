@extends('admin.dashboard')

@section('content')

<div>
    <h2 class="text-2xl md:text-4xl font-extrabold dark:text-white mb-4">Tambah Pengguna</h2>
</div>

<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow dark:bg-gray-800">

    <!-- Tambahkan Baris Ini untuk Menampilkan Pesan Sukses -->
    @if(session('success'))
    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-700 dark:text-green-400">
        {{ session('success') }}
    </div>
    @endif

    <!-- Notifikasi Error Validasi -->
    @if ($errors->any())
    <div class="mb-4 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-700 dark:text-red-400">
        <font class="font-medium">Terjadi kesalahan:</font>
        <ul class="mt-1.5 list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pengguna.store') }}" method="POST" autocomplete="off">
        @csrf

        <!-- Input Nama -->
        <div class="mb-5">
            <label for="name" class="block mb-2.5 text-sm font-medium text-heading dark:text-white">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   placeholder="Nama lengkap" required/>
        </div>

        <!-- Input Email -->
        <div class="mb-5">
            <label for="email" class="block mb-2.5 text-sm font-medium text-heading dark:text-white">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                   class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   placeholder="example@tapselkab.go.id" required/>
        </div>

        <!-- Input Kata Sandi -->
        <div class="mb-5">
            <label for="password" class="block mb-2.5 text-sm font-medium text-heading dark:text-white">Kata
                Sandi</label>
            <input type="password" id="password" name="password"
                   class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   placeholder="••••••••" required/>
        </div>

        <!-- Konfirmasi Kata Sandi -->
        <div class="mb-5">
            <label for="password_confirmation" class="block mb-2.5 text-sm font-medium text-heading dark:text-white">Konfirmasi
                Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   placeholder="••••••••" required/>
        </div>

        <!-- Pilihan Peran -->
        <div class="mb-5">
            <label for="role" class="block mb-2.5 text-sm font-medium text-heading dark:text-white">Peran</label>
            <select id="role" name="role"
                    class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="" disabled selected>Pilih Peran</option>
                <option value="10" {{ old(
                'role') == 10 ? 'selected' : '' }}>Pelihat</option>
                <option value="9" {{ old(
                'role') == 9 ? 'selected' : '' }}>Perangkat Desa</option>
                <option value="8" {{ old(
                'role') == 8 ? 'selected' : '' }}>Desa</option>
                <option value="7" {{ old(
                'role') == 7 ? 'selected' : '' }}>Admin Kecamatan</option>
                <option value="6" {{ old(
                'role') == 6 ? 'selected' : '' }}>Kecamatan</option>
                <option value="5" {{ old(
                'role') == 5 ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <!-- Tombol Submit -->
        <div class="mb-5 flex gap-3">
            <button type="submit"
                    class="inline-flex items-center gap-2 text-white
                    bg-blue-600 hover:bg-blue-700
                    focus:ring-4 focus:ring-blue-300
                    font-medium text-sm px-4 py-2.5
                    rounded-lg shadow-sm transition">
                Buat Akun
            </button>
            <a href="{{ route('pengguna.index') }}"
               class="inline-flex items-center gap-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-4 py-2.5 rounded-lg shadow-sm transition dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
