<?php

use App\Exports\PendaftaranExport;
use App\Http\Controllers\DashboardController;
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

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::get('/users/export/pdf', [UserController::class, 'exportPdf'])->name('users.export.pdf');
    Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
    Route::resource('users', UserController::class);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Penggajian
    Route::get('/penggajian/lowongan-by-user/{user_id}', [PenggajianController::class, 'getLowonganByUser']);
    Route::get('/penggajian/export/pdf', [PenggajianController::class, 'exportPdf'])->name('penggajian.export.pdf');
    Route::get('/penggajian/export/excel', [PenggajianController::class, 'exportExcel'])->name('penggajian.export.excel');
    Route::resource('penggajian', PenggajianController::class);

    // Laporan
    Route::resource('laporan', LaporanController::class);

    // Lowongan
    Route::get('/lowongan/testing', [LowonganController::class, 'testing']);
    Route::get('/lowongan/export-pdf', [LowonganController::class, 'exportPdf'])->name('lowongan.export.pdf');
    Route::get('/lowongan/export_excel', [LowonganController::class, 'export_excel'])->name('lowongan.export_excel');
    Route::resource('lowongan', LowonganController::class);
    

    // Manajemen
    Route::resource('manajemen', ManajemenController::class);
    Route::get('/get-lowongan/{user_id}', [ManajemenController::class, 'getLowongan']);

    // Pendaftaran
    Route::get('/pendaftaran/print/{id}', [PendaftaranController::class, 'print'])->name('pendaftaran.print');

    Route::get('/pendaftaran/export/pdf', [PendaftaranController::class, 'exportPdf'])->name('pendaftaran.export.pdf');
    Route::get('/pendaftaran/export/excel', [PendaftaranController::class, 'exportExcel'])->name('pendaftaran.excel');
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::put('/pendaftaran/{id}/terima', [PendaftaranController::class, 'terima'])->name('pendaftaran.terima');
    Route::put('/pendaftaran/{id}/tolak', [PendaftaranController::class, 'tolak'])->name('pendaftaran.tolak');
});

require __DIR__ . '/auth.php';
