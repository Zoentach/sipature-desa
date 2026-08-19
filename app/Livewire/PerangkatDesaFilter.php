<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\PerangkatDesa;

class PerangkatDesaFilter extends Component
{
    public $kodeKec;
    public $kodeDesa;

    public function updatedKodeKec()
    {
        // Reset desa jika kecamatan diubah
        $this->kodeDesa = null;
    }

    #[Computed()]
    public function kecamatans()
    {
        return Kecamatan::all();
    }

    #[Computed()]
    public function desas()
    {
        return Desa::where('kode_kecamatan', $this->kodeKec)->get();
    }

    #[Computed()]
    public function perangkats()
    {
        // Hanya query jika kedua filter terisi untuk efisiensi
        if ($this->kodeKec && $this->kodeDesa) {
            return PerangkatDesa::where('kode_kecamatan', $this->kodeKec)
                ->where('kode_desa', $this->kodeDesa)
                ->get();
        }

        return collect(); // Return koleksi kosong jika filter belum lengkap
    }

    public function render()
    {
        return view('livewire.perangkat-desa-filter');
    }
}
