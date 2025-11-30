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
    public function izins()
    {
        return Absensi::where('status_kehadiran', 'Pending')->count();
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

    public function prints()
    {
        $namaKec = $this->kodeKec
            ? Kecamatan::where('kode_kecamatan', $this->kodeKec)->value('nama')
            : '';

        $namaDesa = $this->kodeDesa
            ? Desa::where('kode_desa', $this->kodeDesa)->value('nama')
            : '';

        $tanggal = '';
        if ($this->fromDate && $this->toDate) {
            $tanggal = $this->fromDate === $this->toDate
                ? $this->fromDate
                : "{$this->fromDate} s/d {$this->toDate}";
        }

        $tanggalTtd = "Sipirok, " . now('Asia/Jakarta')->translatedFormat('d F Y');

        $this->dispatch(
            'printAbsensi',
            kecamatan: $namaKec,
            desa: $namaDesa,
            tanggal: $tanggal,
            penandatangan: 'Erwin Muhammad Saleh Hrp, S.Sos',
            tanggalttd: $tanggalTtd,
        );
    }

    public
    function render()
    {
        return view('livewire.absensi-filter');
    }
}
