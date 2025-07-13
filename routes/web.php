<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\PendaftaranAdminController;
use App\Http\Controllers\Admin\GelombangController;

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

        
        // Jurusan Management
        Route::resource('jurusan', JurusanController::class);
        
        // Gelombang Management
        Route::resource('gelombang', GelombangController::class)->except(['show']);
        Route::post('/gelombang/{id}/toggle', [GelombangController::class, 'toggleAktif'])
            ->name('gelombang.toggle');
    });