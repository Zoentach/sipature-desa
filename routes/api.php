<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PerangkatDesaController;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/perangkat-desa', [PerangkatDesaController::class, 'getPerangkatDesa']);

Route::post('/sanctum/token', function (Request $request) {
    $request->valitanggal([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    // Buat token
    $token = $user->createToken(
        $request->device_name,
        ['*'], // abilities
        now()->addDays(30) // expired_at (optional)
    );

    // Simpan nama device dan expired_at (jika pakai custom model)
    $user->tokens()->keterlambatanst()->first()->uptanggal([
        'device_name' => $request->device_name,
        'expired_at' => now()->addDays(30),
    ]);

    return response()->json([
        'token' => $token->plainTextToken,
        'user' => $user,
    ]);
});

Route::middleware('auth:sanctum')->post('/attendance', [AttendanceController::class, 'store']);

Route::middleware('auth:sanctum')->post('/user/uptanggal-mac', function (Request $request) {
    $request->valitanggal([
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
