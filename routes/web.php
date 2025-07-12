<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\PendaftaranAdminController;
use App\Http\Controllers\Admin\GelombangController;

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

    // Route untuk gelombang
    Route::resource('gelombang', GelombangController::class)->except(['show']);
    Route::post('/gelombang/{id}/toggle', [GelombangController::class, 'toggleAktif'])->name('gelombang.toggle');

    // Pendaftaran update status (admin)
    Route::patch('/pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.status');
    
    // Admin mengubah tahap
    Route::put('/pendaftaran/{id}/update-tahap', [PendaftaranAdminController::class, 'updateTahap'])->name('pendaftaran.updateTahap');
});

// Route untuk prestasi
Route::get('/prestasi', function () {
    return view('prestasi');
})->name('prestasi');

// Route user melihat status tracking
Route::get('/tracking', [PendaftaranController::class, 'tracking'])->name('formulir.tracking');

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    // Route ke profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

    // Route untuk form pendaftaran
    Route::get('/form', [PendaftaranController::class, 'create'])->name('form.create');
    Route::post('/form', [PendaftaranController::class, 'store'])->name('form.store');
});

Route::middleware(['auth'])->get('/home', function () {
    // Periksa apakah pengguna sudah terdaftar
    if (!Auth::user()->pendaftaran || !Auth::user()->pendaftaran->is_registered) {
        // Jika belum, arahkan ke halaman profile untuk melengkapi form
        return redirect()->route('profile');
    }

    return view('home'); // Halaman home setelah pendaftaran selesai
})->name('home');
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // ... route lainnya
    
    // Route untuk gelombang
    Route::resource('gelombang', GelombangController::class)->except(['show']);
    Route::post('gelombang/{id}/toggle', [GelombangController::class, 'toggleAktif'])
         ->name('gelombang.toggle');
});
Route::middleware(['auth', 'role:admin'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function() {
         Route::resource('gelombang', GelombangController::class)
              ->except(['show']);
     });