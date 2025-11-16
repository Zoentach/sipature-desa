<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi Pengunjung Pameran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6">
    <!-- Logo Section -->
    <div class="flex justify-center items-center space-x-3 mb-4">
        <img src="logo_tapsel.png" alt="Logo Tapanuli Selatan" class="h-12 w-auto">
        <img src="logo_hut.png" alt="Logo HUT Tapanuli Selatan" class="h-12 w-auto">
        <img src="logo_sinergi.png" alt="Logo Sinergi Tapanuli Selatan" class="h-10 w-auto">
    </div>

    <!-- Title -->
    <h2 class="text-center text-xl font-bold text-gray-800">ABSENSI PENGUNJUNG PAMERAN</h2>
    <p class="text-center text-gray-600 text-sm mb-6">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</p>

    <!-- Form -->
    <form
        action="https://docs.google.com/forms/u/0/d/e/1FAIpQLSeZWM9w_4cDNDbKkFRUfAO-lRH_GGEocTVPtzbgDMhOQWdSuQ/formResponse"
        method="POST"
        target="_blank"
        class="space-y-4"
    >
        <!-- Nama -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama</label>
            <input
                name="entry.177435228"
                type="text"
                placeholder="Masukkan nama"
                required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Alamat -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
            <textarea
                name="entry.340673575"
                placeholder="Masukkan alamat"
                required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            ></textarea>
        </div>

        <!-- No HP -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">No. HP / Telp (opsional)</label>
            <input
                name="entry.1183747583"
                type="tel"
                placeholder="Masukkan nomor telepon"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Pekerjaan -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Pekerjaan</label>
            <input
                name="entry.1418557190"
                type="text"
                placeholder="Masukkan pekerjaan"
                required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Foto (upload Google Form login) -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Foto (unggah di halaman login)</label>
            <div class="flex items-center justify-center w-full">
                <a
                    href="https://docs.google.com/forms/d/e/1FAIpQLSeZWM9w_4cDNDbKkFRUfAO-lRH_GGEocTVPtzbgDMhOQWdSuQ/viewform"
                    target="_blank"
                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-lg hover:bg-gray-50 transition text-gray-500"
                >
                    <svg aria-hidden="true" class="w-10 h-10 mb-2 text-gray-400" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 16a4 4 0 010-8 4 4 0 014-4 4 4 0 014 4 4 4 0 010 8m-4 4v-4m0 0l-2 2m2-2l2 2"/>
                    </svg>
                    <p>Klik di sini untuk unggah foto melalui Google Form</p>
                </a>
            </div>
        </div>
        -->

        <!-- Submit -->
        <button
            type="submit"
            class="w-full bg-blue-800 text-white py-2 rounded-lg hover:bg-blue-900 transition"
        >
            SUBMIT
        </button>
    </form>
</div>

</body>
</html>
