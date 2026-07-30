<?php

// 1. IMPORT CONTROLLER BIASA (app/Http/Controllers)
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\VerifikasiAbsensiController;

// 2. IMPORT CONTROLLER API (app/Http/Controllers/Api)
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DesaController;
use App\Http\Controllers\Api\EvaluasiController;
use App\Http\Controllers\Api\PegawaiApiController;
use App\Http\Controllers\Api\PerjalananDinasApiController;
use App\Http\Controllers\Api\PerangkatDesaApiController;
use App\Http\Controllers\Api\ProfilDesaController;
use App\Http\Controllers\Api\RiwayatTugasController;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ==========================================
// API PUBLIK (TIDAK PERLU LOGIN)
// ==========================================
Route::get('/test', function () {
    return 'API OK';
});

// API LOGIN 1 (VERSI LAMA)
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

    $token = $user->createToken('api_token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
});

// API LOGIN 2 (VERSI BARU VIA CONTROLLER)
Route::post('/login', [AuthController::class, 'login']);

Route::get('/desas', function (Request $request) {
    $kodeKec = $request->get('kode_kecamatan');
    if (!$kodeKec) return response()->json([]);

    $desas = Desa::where('kode_kecamatan', $kodeKec)->get();
    return response()->json(
        $desas->map(fn($desa) => [
            'id' => $desa->id,
            'nama' => $desa->nama,
        ])
    );
});

Route::middleware('auth:sanctum')->group(function () {

    // =======================================================
    // GRUP CONTROLLER BIASA (Misal untuk Web/Dashboard Admin)
    // URL: /perangkat-desa, /absensi
    // =======================================================
    Route::group([], function () {

        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/user/update-mac', function (Request $request) {
            $request->validate(['mac_address' => ['required', 'string']]);
            $user = $request->user();
            $user->mac_address = $request->mac_address;
            $user->save();
            return response()->json([
                'message' => 'MAC address updated successfully.',
                'mac_address' => $user->mac_address,
            ]);
        });

        Route::get('/perangkat-desa', [PerangkatDesaController::class, 'getPerangkatDesa']);

        Route::post('/absensi', [AbsensiController::class, 'store']);
        Route::post('/absensi/lampiran', [AbsensiController::class, 'storeLampiran']);

        Route::post('/verifikasi-absensi', [VerifikasiAbsensiController::class, 'store']);
        Route::get('/verifikasi-absensi', [VerifikasiAbsensiController::class, 'getVerifikasiAbsensi']);
    });

    // =======================================================
    // GRUP CONTROLLER API (Misal khusus untuk Aplikasi Android)
    // URL: /v1/perangkat-desa, /v1/dashboard
    // =======================================================
    Route::prefix('v1')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/desa', [DesaController::class, 'index']);
        Route::get('/desa/{id}/profil', [ProfilDesaController::class, 'show']);

        // URL otomatis menjadi: /v1/perangkat-desa (TIDAK BENTROK dengan yang di atas)
        Route::get('/perangkat-desa', [PerangkatDesaApiController::class, 'index']);
        Route::get('/perangkat-desa/{id}', [PerangkatDesaApiController::class, 'show']);

        Route::get('/evaluasi/instrumen', [EvaluasiController::class, 'getInstrumen']);
        Route::post('/evaluasi/simpan', [EvaluasiController::class, 'store']);
        Route::put('/evaluasi/{id}', [EvaluasiController::class, 'update']);
        Route::get('/evaluasi/{id}', [EvaluasiController::class, 'show']);

        Route::get('/riwayat-tugas', [RiwayatTugasController::class, 'index']);
        Route::get('/riwayat-tugas/{id}', [RiwayatTugasController::class, 'show']);

        Route::apiResource('perjalanan-dinas', PerjalananDinasApiController::class)
            ->except(['show'])
            ->names('api.v1.perjalanan-dinas');

        Route::apiResource('pegawai', PegawaiApiController::class)
            ->except(['show'])
            ->names('api.v1.pegawai');
        
    });

});
