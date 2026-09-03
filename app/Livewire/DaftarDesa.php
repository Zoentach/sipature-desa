<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kecamatan;
use App\Models\Desa;

class DaftarDesa extends Component
{
    use WithPagination;

    public $kodeKec = '';
    public $search = '';

    public $isModalOpen = false;
    public $selectedFotoUrl = null;
    public $selectedDesaName = '';

    // Reset pagination ketika filter atau search berubah
    public function updatingKodeKec()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Computed()]
    public function kecamatans()
    {
        return Kecamatan::orderBy('nama')->get();
    }

    #[Computed()]
    public function desas()
    {
        $query = Desa::with('kecamatan');

        // Filter berdasarkan Kecamatan
        if ($this->kodeKec) {
            $query->where('kode_kecamatan', $this->kodeKec);
        }

        // Filter pencarian berdasarkan Nama Desa atau Kode Desa
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('kode_desa', 'like', '%' . $this->search . '%');
            });
        }

        return $query->orderBy('nama')->paginate(10);
    }

    public function showFotoKantor($id)
    {
        $desa = Desa::find($id);

        if ($desa) {
            $this->selectedFotoUrl = $desa->foto_kantor_url;
            $this->selectedDesaName = $desa->nama;
            $this->isModalOpen = true;
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedFotoUrl = null;
        $this->selectedDesaName = '';
    }

    public function render()
    {
        return view('livewire.daftar-desa');
    }
}
