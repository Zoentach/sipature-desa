<div class="relative" wire:click.away="$set('results', [])">
    <input type="text" wire:model="query"
           placeholder="Ketik nama Desa atau Kecamatan"
           class="block w-full p-4 ps-10 text-sm text-gray-900 border rounded-lg bg-gray-50"/>

    @if (!empty($results))
    <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1">
        @forelse($results as $desa)
        <li wire:click="goToDetail({{ $desa->id }})"
            class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
            {{ $desa->nama }}
        </li>
        @empty
        <li class="px-4 py-2 text-gray-500">Tidak ditemukan</li>
        @endforelse
    </ul>
    @endif
</div>
