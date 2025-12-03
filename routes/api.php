<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PerangkatDesaController;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifikasiAbsensiController;

Route::get('/test', function () {
    return 'API OK';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/perangkat-desa', [PerangkatDesaController::class, 'getPerangkatDesa']);

// Login API - tanpa device_name
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    // Buat token tanpa device_name dan tanpa expired_at
    $token = $user->createToken('api_token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
});


//verikasi absensi
Route::middleware('auth:sanctum')->post('/verifikasi-absensi', [VerifikasiAbsensiController::class, 'store']);
Route::middleware('auth:sanctum')->get('/verifikasi-absensi', [VerifikasiAbsensiController::class, 'getVerifikasiAbsensi']);

Route::middleware('auth:sanctum')->post('/absensi', [AbsensiController::class, 'store']);
Route::middleware('auth:sanctum')->post('/absensi/lampiran', [AbsensiController::class, 'storeLampiran']);

Route::middleware('auth:sanctum')->post('/user/update-mac', function (Request $request) {
    $request->validate([
        'mac_address' => ['required', 'string'],
    ]);

    $user = $request->user();
    $user->mac_address = $request->mac_address;
    $user->save();

    return response()->json([
        'message' => 'MAC address uptanggald successfully.',
        'mac_address' => $user->mac_address,
    ]);
});

Route::get('/desas', function (Request $request) {
    $kodeKec = $request->get('kode_kecamatan');

    if (!$kodeKec) {
        return response()->json([]);
    }

    $desas = Desa::where('kode_kecamatan', $kodeKec)->get();

    return response()->json(
        $desas->map(fn($desa) => [
            'id' => $desa->id,    // langsung pakai id
            'nama' => $desa->nama,  // disamakan dengan JS
        ])
    );
});
