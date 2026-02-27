<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama (Public)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Hanya untuk user yang sudah login & verifikasi email)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group Route untuk Profile (Hanya untuk user yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Group Route untuk Mahasiswa & Matakuliah (Hanya untuk user yang sudah login & verifikasi email)
Route::middleware(['auth', 'verified'])->group(function () {

    // ===========================================
    // ROUTE MAHASISWA
    // ===========================================
    
    // 1. ROUTE KHUSUS DELETE (dengan middleware email domain)
    //    Ditempatkan SEBELUM resource route agar tidak konflik
    Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])
        ->middleware('cek.email.ikmi') // Hanya user dengan email @ikmi.ac.id
        ->name('mahasiswa.destroy');
    
    // 2. RESOURCE ROUTE MAHASISWA (semua method kecuali destroy)
    //    Akan menghasilkan route:
    //    GET|HEAD  /mahasiswa ................ mahasiswa.index
    //    GET|HEAD  /mahasiswa/create ......... mahasiswa.create
    //    POST      /mahasiswa ................ mahasiswa.store
    //    GET|HEAD  /mahasiswa/{mahasiswa} .... mahasiswa.show
    //    GET|HEAD  /mahasiswa/{mahasiswa}/edit  mahasiswa.edit
    //    PUT|PATCH /mahasiswa/{mahasiswa} .... mahasiswa.update
    Route::resource('mahasiswa', MahasiswaController::class)->except([
        'destroy' // destroy sudah didefinisikan khusus di atas
    ]);

    // ===========================================
    // ROUTE MATAKULIAH
    // ===========================================
    
    // 1. ROUTE KHUSUS DELETE (dengan middleware email domain)
    Route::delete('/matakuliah/{matakuliah}', [MatakuliahController::class, 'destroy'])
        ->middleware('cek.email.ikmi')
        ->name('matakuliah.destroy');
    
    // 2. RESOURCE ROUTE MATAKULIAH (semua method kecuali destroy)
    Route::resource('matakuliah', MatakuliahController::class)->except([
        'destroy'
    ]);

});

// Auth routes (register, login, logout, dll) - dari Laravel Breeze
require __DIR__.'/auth.php';

// ===========================================
// TESTING ROUTE (Opsional - untuk cek route list)
// ===========================================
// Route::get('/routes', function () {
//     $routes = Route::getRoutes();
//     foreach ($routes as $route) {
//         echo $route->getName() . ' - ' . $route->uri() . '<br>';
//     }
// })->middleware('auth');