<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Absensi;

class AbsensiFilter extends Component
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

        $fromMillis = $this->toMillis($this->fromDate, false);
        $toMillis = $this->toMillis($this->toDate, true);

        $query = Absensi::query();


        if ($this->kodeDesa) {
            // filter desa spesifik
            $query->where('kode_desa', $this->kodeDesa);
        } elseif ($this->kodeKec) {
            // filter semua desa dalam kecamatan
            $desaIds = Desa::where('kode_kecamatan', $this->kodeKec)->pluck('kode_desa');
            $query->whereIn('kode_desa', $desaIds);
        }

        return $query->whereBetween('tanggal', [$fromMillis, $toMillis])->get();

    }

    public
    function render()
    {
        return view('livewire.absensi-filter');
    }


    private
    function toMillis($selectedDate, bool $endOfDay = false)
    {
        $time = $endOfDay ? '23:59:59' : '00:00:00';
        $DateTime = new \DateTime($selectedDate . ' ' . $time, new \DateTimeZone('Asia/Jakarta'));
        return $DateTime->getTimestamp() * 1000;
    }
}
