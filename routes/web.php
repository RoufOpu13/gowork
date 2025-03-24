<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('penggajian', PenggajianController::class);
    Route::resource('laporan', LaporanController::class);

    Route::resource('lowongan', LowonganController::class); //user.create //user.update
    Route::resource('pendaftaran', PendaftaranController::class); //user.create //user.update
    Route::resource('manajemen', ManajemenController::class); //user.create //user.update
    Route::put('/pendaftaran/{id}/terima', [PendaftaranController::class, 'terima'])->name('pendaftaran.terima');
    Route::put('/pendaftaran/{id}/tolak', [PendaftaranController::class, 'tolak'])->name('pendaftaran.tolak');
    Route::get('/get-lowongan/{user_id}', [ManajemenController::class, 'getLowongan']);

});

require __DIR__ . '/auth.php';
