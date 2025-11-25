<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Absensi;

class IzinFilter extends Component
{
    public $kodeKec;
    public $kodeDesa;
    public $fromDate;
    public $toDate;

    public function updatedKodeKec()
    {
        $this->kodeDesa = null;
        $this->fromDate = null;
        $this->toDate = null;
    }

    public function updatedFromDate()
    {
        $this->toDate = $this->fromDate;
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
    public function absensi()
    {
        // --- Tentukan default tanggal ---
        if (!$this->fromDate && !$this->toDate) {
            $today = now('Asia/Jakarta')->format('Y-m-d');
            $this->fromDate = $today;
            $this->toDate = $today;
        }

        $query = Absensi::query();

        if ($this->kodeDesa) {
            // filter desa spesifik
            $query->where('kode_desa', $this->kodeDesa);
        } elseif ($this->kodeKec) {
            // filter semua desa dalam kecamatan
            $desaIds = Desa::where('kode_kecamatan', $this->kodeKec)->pluck('kode_desa');
            $query->whereIn('kode_desa', $desaIds);
        }

        // Karena kolom 'tanggal' di database bertipe DATE (format: YYYY-MM-DD)
        return $query->whereBetween('tanggal', [$this->fromDate, $this->toDate])->get();
    }


    public
    function render()
    {
        return view('livewire.izin-filter');
    }
}
