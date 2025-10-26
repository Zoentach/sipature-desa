<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
<div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center mb-6">Form Pendaftaran</h1>

    <form action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Nama -->
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama <span
                    class="text-red-500">*</span></label>
            <input type="text" id="nama" name="nama" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                   placeholder="Masukkan nama Anda">
        </div>

        <!-- Alamat -->
        <div>
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat <span
                    class="text-red-500">*</span></label>
            <input type="text" id="alamat" name="alamat" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                   placeholder="Masukkan alamat Anda">
        </div>

        <!-- Pekerjaan -->
        <div>
            <label for="pekerjaan" class="block mb-2 text-sm font-medium text-gray-900">Pekerjaan</label>
            <input type="text" id="pekerjaan" name="pekerjaan"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                   placeholder="Masukkan pekerjaan Anda">
        </div>

        <!-- No Telp -->
        <div>
            <label for="no_telp" class="block mb-2 text-sm font-medium text-gray-900">No. Telp</label>
            <input type="text" id="no_telp" name="no_telp"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                   placeholder="Masukkan nomor telepon">
        </div>

        <!-- Foto Selfie -->
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900" for="foto_selfie">Foto Selfie <span
                    class="text-red-500">*</span></label>
            <input type="file" id="foto_selfie" name="foto_selfie" required
                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            <p class="mt-1 text-sm text-gray-500">Upload 1 foto (max 10MB)</p>
        </div>

        <!-- Tombol Submit -->
        <button type="submit"
                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Kirim
        </button>
    </form>
</div>
</body>
</html>
