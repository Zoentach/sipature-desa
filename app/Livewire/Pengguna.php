<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Absensi;

class Pengguna extends Component
{
    public $modalMessage = 'Apakah Anda yakin ingin menghapus pengguna ini?';
    public $selectedUserId;

    public string $search = '';

    #[Computed()]
    public function daftarPengguna()
    {
        $query = User::query();
        // Filter pencarian nama perangkat
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        return $query->get();
    }

    public function confirmTolak($id)
    {
        $this->selectedUserId = $id;
        $this->modalMessage = "Hapus pengguna ini?";
        $this->dispatch('open-confirm-modal');
    }

    public function proceedAction()
    {
        User::find($this->selectedUserId)?->delete();
        $this->dispatch('close-confirm-modal');
    }

    public function closeModal()
    {
        $this->dispatch('close-confirm-modal');
    }

    public function render()
    {
        return view('livewire.daftar-pengguna');
    }
}

