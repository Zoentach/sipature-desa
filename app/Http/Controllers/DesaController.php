<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desa;
use App\Models\PerangkatDesa;

class DesaController extends Controller
{

    public function getAll()
    {
        $desas = Desa::with('kepalaDesa')->get();
        return view('guest.desa.daftar_desa', compact('desas'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('query');

        $results = Desa::where('nama', 'ILIKE', "%{$keyword}%")
            ->with('kepalaDesa')
            ->limit(10)
            ->get();

        return response()->json($results);
    }


    public function detail($id)
    {
        $desa = Desa::with('perangkatDesa', 'gambarDesa')->findOrFail($id);
        return view('guest.desa.detail', compact('desa'));
    }

}

