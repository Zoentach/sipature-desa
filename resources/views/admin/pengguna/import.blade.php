@extends('admin.dashboard')

@section('content')

<div>
    <h2 class="text-2xl md:text-4xl font-extrabold dark:text-white mb-4">Import Pengguna Massal</h2>
</div>

<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow dark:bg-gray-800">

    <!-- Notifikasi Sukses -->
    @if(session('success'))
    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-700 dark:text-green-400">
        {{ session('success') }}
    </div>
    @endif

    <!-- Notifikasi Error dari Session (Contoh: Gagal Sistem/Exception) -->
    @if(session('error'))
    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-700 dark:text-red-400">
        <span class="font-medium">Error:</span> {{ session('error') }}
    </div>
    @endif

    <!-- Notifikasi Error Validasi Form -->
    @if ($errors->any())
    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-700 dark:text-red-400">
        <span class="font-medium">Terjadi kesalahan validasi:</span>
        <ul class="mt-1.5 list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Informasi Panduan Format CSV -->
    <div class="mb-6 p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-700 dark:text-blue-300">
        <span class="font-medium">Panduan Format File CSV:</span>
        <p class="mt-1">Pastikan baris pertama file CSV berisi judul kolom berikut secara berurutan:</p>
        <code class="block bg-blue-100 dark:bg-gray-600 p-2 rounded mt-2 text-xs font-mono">
            name,email,password<br>
            Budi Santoso,budi@example.com,password123<br>
            Ani Wijaya,ani@example.com,password123
        </code>
    </div>

    <!-- Form Import (Wajib menggunakan enctype="multipart/form-data") -->
    <form action="{{ route('pengguna.import.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf

        <!-- Input File CSV -->
        <div class="mb-5">
            <label for="file" class="block mb-2.5 text-sm font-medium text-heading dark:text-white">Pilih File CSV /
                TXT</label>
            <input type="file" id="file" name="file" accept=".csv,.txt"
                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 px-3 py-2.5"
                   required/>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal ukuran file: 2MB.</p>
        </div>

        <!-- Tombol Aksi -->
        <div class="mb-5 flex gap-3">
            <button type="submit"
                    class="inline-flex items-center gap-2 text-white
                    bg-green-600 hover:bg-green-700
                    focus:ring-4 focus:ring-green-300
                    font-medium text-sm px-4 py-2.5
                    rounded-lg shadow-sm transition">
                Upload & Import Data
            </button>
            <a href="{{ route('pengguna.index') }}"
               class="inline-flex items-center gap-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-4 py-2.5 rounded-lg shadow-sm transition dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
