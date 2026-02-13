<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;

// Route Home
Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

// Resource Routes
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('matakuliah', MatakuliahController::class);