<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagihanSppController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;


Route::resource('siswa', SiswaController::class);
Route::resource('spp', SppController::class);
Route::resource('tagihan', TagihanSppController::class);
Route::put('/tagihan/{id}/bayar', [App\Http\Controllers\TagihanSppController::class, 'bayar'])->name('tagihan.bayar');
Route::get('/laporan', [App\Http\Controllers\TagihanSppController::class, 'laporan'])->name('tagihan.laporan');


Route::get('/', [TagihanSppController::class, 'laporan']);

