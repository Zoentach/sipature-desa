@extends('dashboard')

@section('title', 'Import Data Perangkat Desa - Sipature Desa')

@section('content')
<div class="w-full max-w-4xl mx-auto">

    <!-- HEADER HALAMAN -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-900 tracking-tight">
                Import Data Perangkat
            </h2>
            <p class="text-gray-500 text-sm mt-1 font-medium">
                Unggah dokumen Excel untuk menambahkan data aparatur secara massal.
            </p>
        </div>

        <!-- Tombol Kembali -->
        <div>
            <a href="{{ route('perangkat_desa.index') }}"
               class="inline-flex items-center gap-2 text-gray-700 bg-white hover:bg-gray-50 border border-gray-200 focus:ring-4 focus:ring-gray-100 font-bold text-sm px-5 py-2.5 rounded-xl shadow-sm transition-all hover:-translate-x-1">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- KARTU FORMULIR -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <form action="{{ route('perangkat_desa.process_import') }}" method="POST" enctype="multipart/form-data"
              class="p-6 sm:p-8">
            @csrf

            <!-- Pesan Error Session -->
            @if(session('error'))
            <div
                class="mb-6 bg-red-50 border border-red-200 p-4 rounded-2xl flex items-start shadow-sm animate-pulse-once">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-white rounded-full shadow-sm mr-3 mt-0.5">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-red-800">Gagal Mengimpor Data</h4>
                    <p class="text-xs text-red-600 mt-1 font-medium">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            <!-- Pesan Error Validasi File -->
            @error('file')
            <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-2xl flex items-start shadow-sm">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-white rounded-full shadow-sm mr-3 mt-0.5">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-red-800">Terdapat Kesalahan</h4>
                    <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                </div>
            </div>
            @enderror

            <!-- Instruksi Import -->
            <div class="mb-8 bg-emerald-50 border border-emerald-100 p-5 rounded-2xl">
                <div class="flex items-start gap-4">
                    <div class="text-emerald-500 mt-0.5 bg-white p-2 rounded-full shadow-sm">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-emerald-800 mb-2 uppercase tracking-wider">Instruksi
                            Import Data</h3>
                        <ul class="list-disc pl-4 text-sm text-emerald-700 space-y-1.5 font-medium leading-relaxed">
                            <li>Pastikan file yang diunggah berformat <strong class="text-emerald-900">.xlsx, .xls, atau
                                    .csv</strong>.
                            </li>
                            <li>Sistem akan otomatis mencocokkan <strong class="text-emerald-900">Nama Desa</strong> dan
                                <strong class="text-emerald-900">Jabatan</strong> yang tertera pada file.
                            </li>
                            <li class="text-amber-600 font-bold mt-2 flex items-start gap-1.5">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                          d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                                          clip-rule="evenodd"/>
                                </svg>
                                Catatan: Data tidak akan langsung disimpan. Anda akan diarahkan ke halaman Pratinjau
                                (Preview) terlebih dahulu untuk memverifikasi kebenarannya.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Area Upload File -->
            <div class="mb-8">
                <label class="block mb-2 text-sm font-bold text-gray-700">Unggah File Dokumen <span
                        class="text-red-500">*</span></label>

                <!-- Box interaktif yang bisa di-klik pada area manapun -->
                <div
                    class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-gray-200 border-dashed rounded-2xl bg-gray-50 hover:bg-emerald-50/50 hover:border-emerald-400 transition-all relative group cursor-pointer"
                    onclick="document.getElementById('file-upload').click()">

                    <div class="space-y-3 text-center">
                        <svg
                            class="mx-auto h-12 w-12 text-gray-300 group-hover:text-emerald-500 transition-colors duration-300"
                            stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <div class="flex text-sm text-gray-600 justify-center">
                            <span
                                class="relative bg-transparent rounded-md font-extrabold text-emerald-600 group-hover:text-emerald-700">
                                Klik untuk Memilih File
                            </span>
                            <input id="file-upload" name="file" type="file" accept=".xlsx, .xls, .csv" class="sr-only"
                                   required>
                        </div>

                        <p class="text-xs text-gray-400 font-medium">Format XLSX, XLS, atau CSV (Maksimal 10MB)</p>

                        <!-- Tempat memunculkan nama file dengan gaya badge -->
                        <div id="file-name-container" class="mt-4 hidden animate-fade-in">
                            <span
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-sm">
                                <svg class="w-4 h-4 text-emerald-600" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 8v8a5 5 0 1 0 10 0V6.5a3.5 3.5 0 1 0-7 0V15a2 2 0 0 0 4 0V8"/></svg>
                                <span id="file-name-display"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GARIS PEMISAH & TOMBOL SUBMIT -->
            <div class="mt-4 pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl shadow-md transition-all hover:-translate-y-0.5">
                    Lanjut ke Pratinjau
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                              d="M19 12H5m14 0-4 4m4-4-4-4"/>
                    </svg>
                </button>
            </div>

        </form>
    </div>
</div>

<!-- Script untuk memunculkan nama file saat dipilih -->
<script>
    document.getElementById('file-upload').addEventListener('change', function (event) {
        var input = event.target;
        var container = document.getElementById('file-name-container');
        var display = document.getElementById('file-name-display');

        if (input.files && input.files[0]) {
            display.textContent = input.files[0].name;
            container.classList.remove('hidden'); // Memunculkan badge
        } else {
            container.classList.add('hidden'); // Menyembunyikan jika batal memilih
        }
    });
</script>

<!-- Tambahan Tailwind Custom Animation (Opsional, letakkan di file CSS utama jika belum ada) -->
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
    }
</style>
@endsection
