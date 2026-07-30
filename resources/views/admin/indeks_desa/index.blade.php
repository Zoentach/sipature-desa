@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Data Indeks Desa</h2>
    </div>

    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif

    {{--
    BAGIAN ADMIN: Form Import Excel
    Silakan bungkus dengan pengecekan role Anda, misalnya: @if(auth()->user()->role == 'admin')
    --}}
    <div class="bg-gray-50 p-4 rounded-lg border mb-6 shadow-sm">
        <h4 class="font-semibold mb-2">Import Data Excel</h4>
        <form action="{{ route('indeks-desa.import') }}" method="POST" enctype="multipart/form-data"
              class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
            @csrf
            <input type="file" name="file_excel" accept=".xlsx,.xls,.csv" required
                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white p-2">

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Upload & Import
            </button>
        </form>
    </div>
    {{-- END BAGIAN ADMIN --}}

    {{-- Tabel Data --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        {{-- Wrapper ini membuat tabel bisa di-scroll ke samping di Mobile --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm whitespace-nowrap">
                <thead class="uppercase tracking-wider border-b-2 border-gray-200 bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-4">Kode Desa</th>
                    <th scope="col" class="px-6 py-4">Kode Kec</th>
                    <th scope="col" class="px-6 py-4">Tahun</th>
                    <th scope="col" class="px-6 py-4">Skor IKS</th>
                    <th scope="col" class="px-6 py-4">Skor IKE</th>
                    <th scope="col" class="px-6 py-4">Skor IKL</th>
                    <th scope="col" class="px-6 py-4">Skor IDM</th>
                    <th scope="col" class="px-6 py-4">Status</th>

                    {{-- Header Aksi untuk Admin --}}
                    <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($indeks_desa as $desa)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $desa->kode_desa }}</td>
                    <td class="px-6 py-4">{{ $desa->kode_kecamatan }}</td>
                    <td class="px-6 py-4">{{ $desa->tahun }}</td>
                    <td class="px-6 py-4">{{ $desa->skor_iks }}</td>
                    <td class="px-6 py-4">{{ $desa->skor_ike }}</td>
                    <td class="px-6 py-4">{{ $desa->skor_ikl }}</td>
                    <td class="px-6 py-4 font-bold text-blue-600">{{ $desa->skor_idm }}</td>
                    <td class="px-6 py-4">
                        {{-- Jika StatusDesa adalah enum, ambil valuenya atau labelnya --}}
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    {{ $desa->status_desa->value ?? $desa->status_desa }}
                                </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{--
                        BAGIAN ADMIN: Tombol Edit
                        Silakan bungkus dengan pengecekan role Anda, contoh: @if(auth()->user()->role == 'admin')
                        --}}
                        <a href="{{ route('indeks-desa.edit', $desa->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition">
                            Edit
                        </a>
                        {{-- END BAGIAN ADMIN --}}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data Indeks Desa.
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Menampilkan Pagination --}}
    <div class="mt-4">
        {{ $indeks_desa->links() }}
    </div>

</div>
@endsection
