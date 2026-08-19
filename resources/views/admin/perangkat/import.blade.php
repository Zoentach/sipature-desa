@extends('admin.dashboard')

@section('content')

<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Import Data Perangkat Desa</h2>
            <a href="{{ route('perangkat_desa.index') }}"
               class="text-gray-500 hover:text-gray-700 font-medium text-sm">Kembali</a>
        </div>

        <form action="{{ route('perangkat_desa.process_import') }}" method="POST" enctype="multipart/form-data"
              class="p-6">
            @csrf

            @if(session('error'))
            <div class="mb-4 bg-red-50 text-red-700 p-3 rounded border border-red-200">
                {{ session('error') }}
            </div>
            @endif

            @error('file')
            <div class="mb-4 bg-red-50 text-red-700 p-3 rounded border border-red-200">
                {{ $message }}
            </div>
            @enderror

            <div class="mb-6 bg-blue-50 p-4 rounded-md border border-blue-100">
                <h3 class="text-sm font-bold text-blue-800 mb-2">Instruksi Import:</h3>
                <ul class="list-disc pl-5 text-sm text-blue-700 space-y-1">
                    <li>Pastikan file yang diunggah berformat <strong>.xlsx, .xls, atau .csv</strong>.</li>
                    <li>Sistem akan otomatis mencocokkan Nama Desa dan Jabatan.</li>
                    <li class="font-semibold text-red-600 mt-2">Catatan: Data tidak akan langsung disimpan. Anda
                        akan diarahkan ke halaman Pratinjau (Preview) terlebih dahulu.
                    </li>
                </ul>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File Excel</label>
                <div
                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md bg-gray-50 hover:bg-gray-100 transition relative">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                             viewBox="0 0 48 48" aria-hidden="true">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="file-upload"
                                   class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 p-1">
                                <span>Pilih File</span>
                                <!-- Input file -->
                                <input id="file-upload" name="file" type="file" accept=".xlsx, .xls, .csv"
                                       class="sr-only" required>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">XLSX, XLS, atau CSV maksimal 10MB</p>

                        <!-- Tempat memunculkan nama file -->
                        <p id="file-name-display" class="mt-2 text-sm font-semibold text-green-600 hidden"></p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-sm">
                    Lanjut ke Pratinjau &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk memunculkan nama file saat dipilih -->
<script>
    document.getElementById('file-upload').addEventListener('change', function (event) {
        var input = event.target;
        var display = document.getElementById('file-name-display');

        if (input.files && input.files[0]) {
            display.textContent = 'File terpilih: ' + input.files[0].name;
            display.classList.remove('hidden'); // Memunculkan teks
        } else {
            display.classList.add('hidden'); // Menyembunyikan jika batal memilih
        }
    });
</script>

@endsection
