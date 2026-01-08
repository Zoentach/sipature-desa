<?php

namespace App\Livewire;

use App\Models\PerjalananDinas;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PerjalanandinasFilter extends Component
{


    #[Computed()]
    public function perjalanans()
    {
        $perjalananDinas = PerjalananDinas::with('pegawais', 'jenisPerjalanan')->latest()->get();

        return $perjalananDinas;
    }


    public
    function render()
    {
        return view('livewire.perjalanandinas-filter');
    }

}
