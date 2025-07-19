<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\PendaftaranAdminController;
use App\Http\Controllers\Admin\GelombangController;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\Admin\KonselingAdminController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\KontakAdminController;


// Public Routes
Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/prestasi', function () {
    return view('prestasi');
})->name('prestasi');




// Authentication Routes
Auth::routes();

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Home Route
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Profile Route
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    
    // Pendaftaran Routes
        Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [PendaftaranController::class, 'create'])->name('formulir.create');
        Route::post('/', [PendaftaranController::class, 'store'])->name('formulir.store');
        Route::get('/profil', [PendaftaranController::class, 'show'])->name('formulir.show');
        Route::get('/edit', [PendaftaranController::class, 'edit'])->name('formulir.edit');
        Route::put('/', [PendaftaranController::class, 'update'])->name('formulir.update');
        Route::get('/tracking', [PendaftaranController::class, 'tracking'])->name('formulir.tracking');
        Route::get('/konseling', [KonselingController::class, 'index'])->name('konseling.index');  // Halaman form pengajuan konseling
        Route::post('/konseling', [KonselingController::class, 'store'])->name('konseling.store');  // Proses pengajuan konseling
        Route::get('/konseling/riwayat', [KonselingController::class, 'riwayat'])->name('konseling.riwayat');
        Route::get('/kontak', [KontakController::class, 'create'])->name('kontak.form');
        Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.kirim');
  // Riwayat pengajuan konseling
    });
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Pendaftaran Management
        Route::resource('pendaftaran', PendaftaranAdminController::class)->except(['create', 'store']);
        Route::patch('/pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])
            ->name('pendaftaran.status');
        Route::put('/pendaftaran/{id}/update-tahap', [PendaftaranAdminController::class, 'updateTahap'])
            ->name('pendaftaran.updateTahap');
        Route::patch('/pendaftaran/{id}/update-gelombang', [PendaftaranController::class, 'updateGelombang'])->name('pendaftaran.updateGelombang');
        
        // Add status and gelombang routes
        Route::get('admin/pendaftaran/status', [PendaftaranAdminController::class, 'byStatus'])->name('pendaftaran.Status');
        Route::get('admin/pendaftaran/gelombang', [PendaftaranAdminController::class, 'byGelombang'])->name('pendaftaran.Gelombang');
        
        // Menyimpan status siswa (diterima/ditolak)
        Route::post('admin/pendaftaran/konfirmasi/{id}', [PendaftaranAdminController::class, 'konfirmasiSiswa'])->name('pendaftaran.konfirmasi.siswa');
        // Jurusan Management
        Route::resource('jurusan', JurusanController::class);
        
        // Gelombang Management
        Route::resource('gelombang', GelombangController::class)->except(['show']);
        Route::post('/gelombang/{id}/toggle', [GelombangController::class, 'toggleAktif'])
            ->name('gelombang.toggle'); Route::get('/konseling', [KonselingAdminController::class, 'index'])->name('konseling.index');  // Lihat semua pengajuan konseling
        Route::get('/konseling/{id}', [KonselingAdminController::class, 'show'])->name('konseling.show');  // Lihat detail pengajuan
        Route::patch('/konseling/{id}', [KonselingAdminController::class, 'update'])->name('konseling.update');
        Route::get('/kontak', [KontakAdminController::class, 'index'])->name('kontak.index');
    });
