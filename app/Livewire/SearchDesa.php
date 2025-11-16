<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Desa;

class SearchDesa extends Component
{
    public $query = '';
    public $results = [];

    public function uptanggaldQuery()
    {
        $this->results = Desa::where('nama', 'ILIKE', '%' . $this->query . '%')
            ->orWhere('kode_kecamatan', 'ILIKE', '%' . $this->query . '%')
            ->limit(10)
            ->get();
    }

    public function goToDetail($id)
    {
        return redirect()->to('/desa/' . $id);
    }

    public function render()
    {
        return view('livewire.search-desa');
    }
}
