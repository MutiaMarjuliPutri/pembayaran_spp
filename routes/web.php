<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagihanSppController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\SppController;

Route::get('/siswa/tagihan', [SiswaAuthController::class, 'tagihan'])->name('siswa.tagihan');
Route::resource('siswa', SiswaController::class);
Route::resource('spp', SppController::class);
Route::resource('tagihan', TagihanSppController::class);
Route::put('/tagihan/{id}/bayar', [App\Http\Controllers\TagihanSppController::class, 'bayar'])->name('tagihan.bayar');
Route::get('/laporan', [App\Http\Controllers\TagihanSppController::class, 'laporan'])->name('tagihan.laporan');


Route::get('/tagihan/laporan', [TagihanSppController::class, 'laporan']);
Route::get('/tagihan', [TagihanSppController::class, 'index'])->name('tagihan.index');


Route::get('/', [SiswaAuthController::class, 'showLoginForm'])->name('siswa.login.form');
Route::get('/siswa/tagihan/{id}/bayar', [SiswaAuthController::class, 'showBayarForm'])->name('siswa.bayar.form');
Route::post('/siswa/tagihan/{id}/bayar', [SiswaAuthController::class, 'prosesBayar'])->name('siswa.bayar');


Route::post('/siswa/login', [SiswaAuthController::class, 'login'])->name('siswa.login');

Route::post('/siswa/logout', [SiswaAuthController::class, 'logout'])->name('siswa.logout');

