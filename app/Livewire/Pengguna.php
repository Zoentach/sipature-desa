<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Absensi;

class Pengguna extends Component
{
    public
    function render()
    {
        return view('livewire.daftar-pengguna');
    }
}
