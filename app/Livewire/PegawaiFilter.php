<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Pegawai;
use App\Models\Desa;
use App\Models\Absensi;

class PegawaiFilter extends Component
{


    #[Computed()]
    public function pegawais()
    {
        $pegawai = Pegawai::with('unitKerja')->get();


        return $pegawai;
    }


    public
    function render()
    {
        return view('livewire.pegawai-filter');
    }
}
