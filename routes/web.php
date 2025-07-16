<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\SppController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\TagihanSppController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Siswa\TagihanController;
use App\Http\Controllers\Siswa\ChatController as SiswaChatController;
use App\Http\Controllers\Siswa\LaporanController as SiswaLaporanController;
use App\Http\Controllers\Siswa\ProfilController;
use App\Http\Controllers\Siswa\PembayaranController;

/*
|--------------------------------------------------------------------------
| Redirect root ke halaman login
|--------------------------------------------------------------------------
*/
Route::get('/', [LoginController::class, 'showLoginForm'])->name('root');

/*
|--------------------------------------------------------------------------
| Login & Logout
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Siswa
    Route::resource('siswa', SiswaController::class);

    // SPP
    Route::resource('spp', SppController::class);

    // Tagihan SPP
    Route::resource('tagihan', TagihanSppController::class, [
        'names' => [
            'index' => 'admin.tagihan.index',
            'create' => 'admin.tagihan.create',
            'store' => 'admin.tagihan.store',
            'edit' => 'admin.tagihan.edit',
            'update' => 'admin.tagihan.update',
            'destroy' => 'admin.tagihan.destroy',
        ]
    ]);
    Route::put('/tagihan/{id}/verifikasi', [TagihanSppController::class, 'verifikasi'])->name('admin.tagihan.verifikasi');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // Pengaturan
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::delete('/pengaturan/{id}', [PengaturanController::class, 'destroy'])->name('pengaturan.destroy');

    // Chat Admin ↔ Siswa
    Route::prefix('chat')->group(function() {
        Route::get('/', [\App\Http\Controllers\Admin\ChatController::class, 'index'])->name('admin.chat.index');
        Route::get('/{siswa_id}', [\App\Http\Controllers\Admin\ChatController::class, 'show'])->name('admin.chat.show');
        Route::post('/send', [\App\Http\Controllers\Admin\ChatController::class, 'send'])->name('admin.chat.send');
    });
});

/*
|--------------------------------------------------------------------------
| Siswa Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('siswa.dashboard_siswa'))->name('siswa.dashboard_siswa');

    // Tagihan SPP
    Route::get('/tagihan', [TagihanController::class, 'index'])->name('siswa.tagihan');
    Route::get('/tagihan/{id}/bayar', [TagihanController::class, 'showBayar'])->name('siswa.bayar');
    Route::post('/tagihan/{id}/bayar', [TagihanController::class, 'prosesBayar'])->name('siswa.prosesBayar');

    // Nota Pembayaran
    Route::get('/tagihan/{id}/nota', [PembayaranController::class, 'cetakNota'])->name('siswa.cetakNota');

    // Laporan
    Route::get('/laporan', [SiswaLaporanController::class, 'index'])->name('siswa.laporan');
    Route::get('/laporan/cetak/{id}', [SiswaLaporanController::class, 'cetakNota'])->name('siswa.laporan.cetak');

    // Profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('siswa.profil');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('siswa.profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('siswa.profil.update');

        // Chat Siswa
    Route::get('/chat', [\App\Http\Controllers\Siswa\ChatController::class, 'index'])->name('siswa.chat');
    Route::post('/chat/send', [\App\Http\Controllers\Siswa\ChatController::class, 'send'])->name('siswa.chat.send');
});
