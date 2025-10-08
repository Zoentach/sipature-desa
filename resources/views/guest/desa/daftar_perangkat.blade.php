<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perangkat Desa Terdaftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
<div class="flex items-center justify-center min-h-screen">
    <div
        class="w-full max-w-4xl bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <!-- Header -->
        <div class="px-6 py-6 text-center border-b border-gray-200 dark:border-gray-600">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                Perangkat Desa Terdaftar
            </h2>
        </div>

        <!-- Content -->
        <div class="p-8">
            <dl class="grid max-w-screen-xl grid-cols-1 gap-8 mx-auto text-gray-900 sm:grid-cols-3 dark:text-white">
                <div class="flex flex-col items-center justify-center text-center">
                    <dt class="mb-2 text-4xl font-extrabold">{{ $jumlahGrup01 }}</dt>
                    <dd class="text-lg font-medium text-gray-600 dark:text-gray-400">Kepala Desa</dd>
                </div>
                <div class="flex flex-col items-center justify-center text-center">
                    <dt class="mb-2 text-4xl font-extrabold">{{ $jumlahGrup02 }}</dt>
                    <dd class="text-lg font-medium text-gray-600 dark:text-gray-400">Perangkat Desa</dd>
                </div>
                <div class="flex flex-col items-center justify-center text-center">
                    <dt class="mb-2 text-4xl font-extrabold">{{ $jumlahGrup03 }}</dt>
                    <dd class="text-lg font-medium text-gray-600 dark:text-gray-400">BPD</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
</body>
</html>
