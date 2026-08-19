<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Kecamatan;
use App\Models\VerifikasiAbsensi;

class VerifikasiDevice extends Component
{
    public $kodeKec = '';
    public $search = '';

    public $isModalOpen = false;
    public $deleteId = null;

    #[Computed()]
    public function kecamatans()
    {
        return Kecamatan::all();
    }

    #[Computed()]
    public function verifikasis()
    {
        $query = VerifikasiAbsensi::with(['user', 'desa']);

        // Filter berdasarkan Kecamatan
        if ($this->kodeKec) {
            $query->where('kode_kecamatan', $this->kodeKec);
        }

        // Filter Pencarian berdasarkan Nama User atau Nama Desa
        if ($this->search) {
            $query->where(function ($q) {
                $q->whereHas('user', function ($userQuery) {
                    $userQuery->where('name', 'like', '%' . $this->search . '%');
                })
                    ->orWhereHas('desa', function ($desaQuery) {
                        $desaQuery->where('nama', 'like', '%' . $this->search . '%');
                    });
            });
        }

        return $query->get();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isModalOpen = true;
    }

    public function delete()
    {
        if ($this->deleteId) {
            VerifikasiAbsensi::find($this->deleteId)->delete();
        }

        $this->isModalOpen = false;
        $this->deleteId = null;

        session()->flash('message', 'Data verifikasi berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->deleteId = null;
    }

    public function render()
    {
        // PERUBAHAN DI SINI: Mengarah ke view verifikasi-device.blade.php
        return view('livewire.verifikasi-device');
    }
}
