<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\IndeksDesaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\PerjalananDinasController;
use App\Http\Controllers\RegulasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiAbsensiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Pastikan controller ini sesuai dengan sistem Auth Anda
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// ==========================================
// 1. ROUTES GUEST (Bisa diakses tanpa login)
// ==========================================
Route::get('/', function () {
    return view('guest.beranda');
})->name('beranda');

Route::get('/tentang-kami', function () {
    return view('guest.tentang.tentang');
})->name('tentang');

// -- Desa --
Route::prefix('desa')->name('desa.')->group(function () {
    Route::get('/', [DesaController::class, 'getAll'])->name('index');
    Route::get('/search', [DesaController::class, 'search'])->name('search');
    Route::get('/{id}', [DesaController::class, 'detail'])->name('detail');
});
// (Route '/daftar-desa' ditiadakan karena fungsinya sama persis dengan '/desa')

// -- Perangkat Desa --
Route::prefix('perangkat')->name('perangkat.')->group(function () {
    Route::get('/', [PerangkatDesaController::class, 'index'])->name('index');
    Route::get('/daftar', [PerangkatDesaController::class, 'getDaftarPerangkat'])->name('daftar');
    Route::get('/{id}', [PerangkatDesaController::class, 'detail'])->name('detail');
});

// -- Umum / API / Export --
Route::get('/monitoring-spt', [PegawaiController::class, 'monitoring'])->name('umum.monitoring-spt');
Route::get('/api/perangkat', [PerangkatDesaController::class, 'getPerangkatDesa'])->name('perangkat_desa.api');
Route::get('/export/{kode_desa}', [ExportController::class, 'exportByDesa'])->name('export.kredensial');
Route::get('/indeks-desa', [IndeksDesaController::class, 'index'])->name('indeks-desa.index');


// ==========================================
// 2. ROUTES AUTH & VERIFIED (Wajib Login & Verifikasi)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // -- Dashboard --
    Route::view('dashboard', 'admin.dashboard.index')->name('dashboard');

    // -- Pengguna --
    Route::prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/daftar', [UserController::class, 'index'])->name('index');
        Route::get('/tambah', [UserController::class, 'tambah'])->name('tambah');
        Route::post('/tambah', [UserController::class, 'store'])->name('store');
        Route::get('/import', [UserController::class, 'importForm'])->name('import');
        Route::post('/import', [UserController::class, 'importStore'])->name('import.store');
    });

    // -- Pegawai --
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');

    // -- Manajemen Perangkat Desa (CRUD Admin) --
    Route::get('/perangkat-desa', [PerangkatDesaController::class, 'index'])->name('perangkat_desa.index');
    Route::get('/perangkat-desa/create', [PerangkatDesaController::class, 'create'])->name('perangkat_desa.create');
    Route::post('/perangkat-desa', [PerangkatDesaController::class, 'store'])->name('perangkat_desa.store');
    Route::get('/perangkat-desa/{id}/edit', [PerangkatDesaController::class, 'edit'])->name('perangkat_desa.edit');
    Route::put('/perangkat-desa/{id}', [PerangkatDesaController::class, 'update'])->name('perangkat_desa.update');

    // -- Import Excel Perangkat Desa --
    Route::get('/perangkat-desa/import', [PerangkatDesaController::class, 'import'])->name('perangkat_desa.import');
    Route::post('/perangkat-desa/import', [PerangkatDesaController::class, 'processImport'])->name('perangkat_desa.process_import');
    Route::post('/perangkat-desa/import/confirm', [PerangkatDesaController::class, 'confirmImport'])->name('perangkat_desa.confirm_import'); // <--- Ini yang baru

    // -- Regulasi --
    Route::prefix('data-regulasi')->name('regulasi.')->group(function () {
        Route::get('/', [RegulasiController::class, 'index'])->name('index');
        Route::get('/tambah', [RegulasiController::class, 'tambah'])->name('tambah');
        Route::post('/', [RegulasiController::class, 'store'])->name('store');
    });

    // -- Perjalanan Dinas --
    Route::prefix('perjalanan-dinas')->name('perjalanan-dinas.')->group(function () {
        Route::get('/', [PerjalananDinasController::class, 'index'])->name('index');
        Route::get('/tambah', [PerjalananDinasController::class, 'tambah'])->name('tambah');
        Route::post('/', [PerjalananDinasController::class, 'store'])->name('store');
        Route::get('/{id}/ubah', [PerjalananDinasController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PerjalananDinasController::class, 'update'])->name('update');
        Route::delete('/{id}', [PerjalananDinasController::class, 'destroy'])->name('destroy');
    });

    // -- Admin Indeks Desa --
    Route::prefix('admin/indeks-desa')->name('indeks-desa.')->group(function () {
        Route::get('/', [IndeksDesaController::class, 'adminIndex'])->name('admin_index');
        Route::post('/import', [IndeksDesaController::class, 'import'])->name('import');
        Route::get('/{indeksDesa}/edit', [IndeksDesaController::class, 'edit'])->name('edit');
        Route::put('/{indeksDesa}', [IndeksDesaController::class, 'update'])->name('update');
    });

    // -- LOGOUT ROUTE --
    // Menggunakan method POST untuk keamanan (mencegah CSRF pada saat logout)
    Route::post('/logout', function (Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    })->name('logout');

});


// ==========================================
// 3. ROUTES ABSENSI SAPA DESA
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    // -- Absensi --
    Route::get('/ringkasan-absensi', [AbsensiController::class, 'ringkasan'])->name('absensi.ringkasan');
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/pengajuan-izin', [AbsensiController::class, 'izin'])->name('absensi.izin');


    Route::get('/verifikasi-device', [VerifikasiAbsensiController::class, 'index'])->name('absensi.device');
    Route::get('/ubah-device/{id}', [VerifikasiAbsensiController::class, 'edit'])->name('device.edit');
    Route::put('/ubah-device/{id}', [VerifikasiAbsensiController::class, 'update'])->name('device.update');
});


// ==========================================
// 3. ROUTES AUTH ONLY (Settings Volt)
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
