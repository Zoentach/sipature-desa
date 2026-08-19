@extends('admin.dashboard')

@section('content')

<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Ubah Verifikasi Device</h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('device.update', $verifikasi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Informasi Read-Only -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama User / ID</label>
                <input type="text" value="{{ $verifikasi->user->name ?? 'Unknown' }} (ID: {{ $verifikasi->user_id }})"
                       class="bg-gray-100 border border-gray-300 rounded-md w-full px-3 py-2 text-gray-600" disabled>
            </div>

            <!-- Input Edit Mac Address -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">MAC Address</label>
                <input type="text" name="mac_address" value="{{ old('mac_address', $verifikasi->mac_address) }}"
                       class="border border-gray-300 rounded-md w-full px-3 py-2 focus:ring-2 focus:ring-blue-500">
                @error('mac_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Input Edit Latitude -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Latitude</label>
                <input type="text" name="latitude" value="{{ old('latitude', $verifikasi->latitude) }}"
                       class="border border-gray-300 rounded-md w-full px-3 py-2 focus:ring-2 focus:ring-blue-500">
                @error('latitude') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Input Edit Longitude -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Longitude</label>
                <input type="text" name="longitude" value="{{ old('longitude', $verifikasi->longitude) }}"
                       class="border border-gray-300 rounded-md w-full px-3 py-2 focus:ring-2 focus:ring-blue-500">
                @error('longitude') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Perubahan
                </button>
                <a href="{{ route('absensi.device') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
