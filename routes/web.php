<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\PendaftaranAdminController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route untuk pendaftaran formulir (hanya untuk user yang sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/formulir', [PendaftaranController::class, 'create'])->name('formulir.create');
    Route::post('/formulir', [PendaftaranController::class, 'store'])->name('formulir.store');
    Route::get('/profil', [PendaftaranController::class, 'show'])->name('formulir.show');
    Route::get('/formulir/edit', [PendaftaranController::class, 'edit'])->name('formulir.edit');
    Route::put('/formulir', [PendaftaranController::class, 'update'])->name('formulir.update');
});

// Route untuk halaman About
Route::get('/about', function () {
    return view('about');
})->name('about');

// Admin route dengan middleware role admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Pendaftaran admin
    Route::get('/pendaftaran', [PendaftaranAdminController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{id}', [PendaftaranAdminController::class, 'show'])->name('pendaftaran.show');
    Route::delete('/pendaftaran/{id}', [PendaftaranAdminController::class, 'destroy'])->name('pendaftaran.destroy');
    
    // Route untuk jurusan
    Route::resource('jurusan', JurusanController::class);

    // Pendaftaran update status (admin)
    Route::patch('/pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.status');
});

// Route untuk prestasi
Route::get('/prestasi', function () {
    return view('prestasi');
})->name('prestasi');

// Route user melihat status tracking
Route::get('/tracking', [PendaftaranController::class, 'tracking'])->name('formulir.tracking');

// Route admin mengubah tahap
Route::post('/admin/pendaftaran/{id}/tahap', [PendaftaranController::class, 'updateTahap'])->name('admin.pendaftaran.updateTahap');
