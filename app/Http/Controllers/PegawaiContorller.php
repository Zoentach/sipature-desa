<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Absensi;
use App\Models\VerifikasiAbsensi;
use Illuminate\Http\Request;

class PegawaiContorller extends Controller
{

    public function index()
    {
        return view('admin.umum.pegawai.index');
    }

}
