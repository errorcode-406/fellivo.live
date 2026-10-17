<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PencariController;
use App\Models\Kos;

// ==========================================
// RUTE PUBLIK (Bisa diakses tanpa login)
// ==========================================
Route::get('/', [PencariController::class, 'index'])->name('pencari.index');
Route::get('/kos/{id}/detail', [PencariController::class, 'show'])->name('pencari.show');

// Rute Dashboard (Sudah dimodifikasi untuk Pemilik Kos)
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Kalau yang login adalah pemilik kos, ambil data kos miliknya beserta kamar fisik & fotonya
    if ($user->role === 'pemilik') {
        $kos_milik_user = Kos::with('kamars')->where('pemilik_id', $user->id)->get();
        return view('dashboard', compact('kos_milik_user'));
    }

    // Tampilan default untuk pencari kos atau admin
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup Rute Wajib Login (Khusus Pemilik Kos / Admin)
Route::middleware('auth')->group(function () {
    
    // Rute Profile Bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================================
    // RUTE KELOLA PROPERTI & KAMAR FISIK
    // ==========================================
    
    // Rute Kelola Kos
    Route::get('/kos/tambah', [KosController::class, 'create'])->name('kos.create');
    Route::post('/kos', [KosController::class, 'store'])->name('kos.store');

    // Rute Tambah Unit Kamar Fisik (URL membawa ID Kos)
    Route::get('/kos/{kos_id}/kamar/tambah', [KamarController::class, 'create'])->name('kamar.create');
    Route::post('/kos/{kos_id}/kamar', [KamarController::class, 'store'])->name('kamar.store');
    
    // 👇 INI YANG DITAMBAHKAN: Rute Edit & Hapus Unit Kamar Fisik 👇
    Route::get('/kamar/{id}/edit', [KamarController::class, 'edit'])->name('kamar.edit');
    Route::put('/kamar/{id}', [KamarController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/{id}', [KamarController::class, 'destroy'])->name('kamar.destroy');
    
});

// Rute Autentikasi
require __DIR__.'/auth.php';