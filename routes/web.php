<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/latihan', [LatihanController::class, 'index']);

Route::resource('mahasiswa', MahasiswaController::class);
