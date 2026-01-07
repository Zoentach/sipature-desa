<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Regulasi;

class RegulasiFilter extends Component
{
    public string $search = '';

    #[Computed]
    public function daftarRegulasi()
    {
        return Regulasi::with(['jenisRegulasi', 'unitKerja'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nomor_regulasi', 'like', '%' . $this->search . '%')
                        ->orWhere('tentang', 'like', '%' . $this->search . '%')
                        ->orWhereHas('jenisRegulasi', function ($q2) {
                            $q2->where('nama_regulasi', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('unitKerja', function ($q3) {
                            $q3->where('nama_unit', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderByDesc('tahun')
            ->get();
    }

    public function render()
    {
        return view('livewire.regulasi');
    }
}
