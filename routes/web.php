<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;

Route::resource('siswa', SiswaController::class);
Route::resource('spp', SppController::class);


Route::get('/', function () {
    return view('welcome');
});
