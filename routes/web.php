<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\DesaController;
use \App\Http\Controllers\PerangkatDesaController;

Route::get('/', function () {
    return view('guest.welcome');
})->name('home');

#DESA CONTROLLER
Route::get('/search', [DesaController::class, 'search'])->name('search');
Route::get('/daftar-desa', [DesaController::class, 'getAll'])->name('desa.daftar');
Route::get('/detail-desa/{id}', [DesaController::class, 'detail'])->name('desa.detail');
Route::get('/desa', [DesaController::class, 'getAll'])->name('desa.index');
#Route::get('/desa/search', [DesaController::class, 'search'])->name('desa.search');
Route::get('/desa/{desa}', [DesaController::class, 'detail'])->name('desa.detail');

#PerangkatDesaController
Route::get('/daftar-perangkat', [PerangkatDesaController::class, 'getDaftarPerangkat'])->name('perangkat.daftar');
Route::get('/detail-perangkat/{id}', [PerangkatDesaController::class, 'detail'])->name('perangkat.detail');
#tambahan
Route::get('/perangkat', [PerangkatDesaController::class, 'getDaftarPerangkat'])->name('perangkat_desa.daftar');
Route::get('/perangkat/{id}', [PerangkatDesaController::class, 'detail'])->name('perangkat_desa.detail');
Route::get('/api/perangkat', [PerangkatDesaController::class, 'getPerangkatDesa'])->name('perangkat_desa.api');
Route::get('/perangkat/create', [PerangkatDesaController::class, 'create'])->name('perangkat_desa.create');
Route::post('/perangkat', [PerangkatDesaController::class, 'store'])->name('perangkat_desa.store');

Route::view('dashboard', 'admin/perangkat/perangkat')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pengajuan-izin', [AbsensiController::class, 'izin'])->name('absensi.izin');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/export/{kode_desa}', [ExportController::class, 'exportByDesa'])->name('export.kredensial');


require __DIR__ . '/auth.php';
