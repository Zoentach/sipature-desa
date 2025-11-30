<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Absensi;
use App\Models\User;
use App\Models\VerifikasiAbsensi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.pengguna.index');
    }
}
