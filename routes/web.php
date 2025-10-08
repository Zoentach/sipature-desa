<?php

use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\DesaController;
use \App\Http\Controllers\PerangkatDesaController;
use \App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('guest.welcome');
})->name('home');

Route::get('/search', [DesaController::class, 'search'])->name('search');
Route::get('/daftar-desa', [DesaController::class, 'getAll'])->name('desa.daftar');
Route::get('/detail-desa/{id}', [DesaController::class, 'detail'])->name('desa.detail');
Route::get('/daftar-perangkat', [PerangkatDesaController::class, 'getDaftarPerangkat'])->name('perangkat.daftar');
Route::get('/detail-perangkat/{id}', [PerangkatDesaController::class, 'detail'])->name('perangkat.detail');

Route::view('dashboard', 'admin/perangkat/perangkat')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/absensi', [AttendanceController::class, 'index'])->name('absensi.index');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/export/{kode_desa}', [ExportController::class, 'exportByDesa'])->name('export.kredensial');


require __DIR__ . '/auth.php';
