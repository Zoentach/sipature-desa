<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Api\PegawaiApiController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\Api\PerjalananDinasApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\VerifikasiAbsensiController;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'API OK';
});

// ==========================================
// API LOGIN 1 (VERSI LAMA)
// ==========================================
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

// ==========================================
// API LOGIN 2 (VERSI BARU VIA CONTROLLER)
// ==========================================
Route::post('/login', [AuthController::class, 'login']);

// ==========================================
// API PUBLIK LAINNYA
// ==========================================
Route::get('/desas', function (Request $request) {
    $kodeKec = $request->get('kode_kecamatan');

    if (!$kodeKec) {
        return response()->json([]);
    }

    $desas = Desa::where('kode_kecamatan', $kodeKec)->get();

    return response()->json(
        $desas->map(fn($desa) => [
            'id' => $desa->id,
            'nama' => $desa->nama,
        ])
    );
});

// ==========================================
// ROUTE YANG WAJIB LOGIN (AUTH:SANCTUM)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {

    // Profil User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Perangkat Desa
    Route::get('/perangkat-desa', [PerangkatDesaController::class, 'getPerangkatDesa']);

    // Verifikasi Absensi
    Route::post('/verifikasi-absensi', [VerifikasiAbsensiController::class, 'store']);
    Route::get('/verifikasi-absensi', [VerifikasiAbsensiController::class, 'getVerifikasiAbsensi']);

    // Absensi
    Route::post('/absensi', [AbsensiController::class, 'store']);
    Route::post('/absensi/lampiran', [AbsensiController::class, 'storeLampiran']);

    // Update MAC Address
    Route::post('/user/update-mac', function (Request $request) {
        $request->validate([
            'mac_address' => ['required', 'string'],
        ]);

        $user = $request->user();
        $user->mac_address = $request->mac_address;
        $user->save();

        return response()->json([
            'message' => 'MAC address updated successfully.',
            'mac_address' => $user->mac_address,
        ]);
    });

    // ==========================================
    // ROUTE CRUD PERJALANAN DINAS
    // ==========================================
    Route::apiResource('perjalanan-dinas', PerjalananDinasApiController::class)
        ->except(['show'])
        ->names('api.perjalanan-dinas');

    // ==========================================
    // ROUTE CRUD PEGAWAI
    // ==========================================
    Route::apiResource('pegawai', PegawaiApiController::class)
        ->except(['show'])
        ->names('api.pegawai');

});
