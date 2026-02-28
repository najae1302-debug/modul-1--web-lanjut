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

// ===========================================
// HALAMAN PUBLIK (TANPA LOGIN)
// ===========================================
Route::get('/', function () {
    return view('welcome');
});

// ===========================================
// ROUTE TESTING DOMPDF (CEK INSTALASI)
// ===========================================
Route::get('/test-pdf', function() {
    $pdf = Barryvdh\DomPDF\Facade\Pdf::loadHTML('
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                h1 { color: #3490dc; }
                .success { color: green; font-weight: bold; }
            </style>
        </head>
        <body>
            <h1>✅ DOMPDF BERHASIL DIINSTAL!</h1>
            <p>Selamat! Library DomPDF sudah terpasang dengan benar di Laravel 12.</p>
            <p class="success">Tanggal Test: ' . date('d F Y H:i:s') . '</p>
            <hr>
            <p>File ini adalah hasil generate dari route /test-pdf</p>
        </body>
        </html>
    ');
    return $pdf->download('test-dompdf-berhasil.pdf');
})->name('test.pdf');

// ===========================================
// DASHBOARD (HANYA LOGIN & VERIFIED)
// ===========================================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ===========================================
// GROUP ROUTE PROFILE (HANYA LOGIN)
// ===========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===========================================
// GROUP ROUTE MAHASISWA & MATAKULIAH
// (HANYA LOGIN & VERIFIED)
// ===========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // ===========================================
    // ROUTE MAHASISWA
    // ===========================================
    
    // 1. ROUTE KHUSUS DELETE (dengan middleware email domain)
    Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])
        ->middleware('cek.email.ikmi')
        ->name('mahasiswa.destroy');
    
    // 2. ROUTE CETAK PDF MAHASISWA
    Route::get('/mahasiswa/cetak-pdf', [MahasiswaController::class, 'cetak_pdf'])
        ->name('mahasiswa.cetak_pdf');
    
    // 3. ROUTE PREVIEW PDF MAHASISWA
    Route::get('/mahasiswa/preview-pdf', [MahasiswaController::class, 'preview_pdf'])
        ->name('mahasiswa.preview_pdf');
    
    // 4. ROUTE EXPORT EXCEL MAHASISWA (OPSIONAL - BISA DITAMBAHKAN NANTI)
    // Route::get('/mahasiswa/export-excel', [MahasiswaController::class, 'export_excel'])
    //     ->name('mahasiswa.export_excel');
    
    // 5. RESOURCE ROUTE MAHASISWA (SEMUA METHOD KECUALI DESTROY)
    Route::resource('mahasiswa', MahasiswaController::class)->except([
        'destroy'
    ]);

    // ===========================================
    // ROUTE MATAKULIAH
    // ===========================================
    
    // 1. ROUTE KHUSUS DELETE (dengan middleware email domain)
    Route::delete('/matakuliah/{matakuliah}', [MatakuliahController::class, 'destroy'])
        ->middleware('cek.email.ikmi')
        ->name('matakuliah.destroy');
    
    // 2. ROUTE CETAK PDF MATAKULIAH
    Route::get('/matakuliah/cetak-pdf', [MatakuliahController::class, 'cetak_pdf'])
        ->name('matakuliah.cetak_pdf');
    
    // 3. ROUTE PREVIEW PDF MATAKULIAH
    Route::get('/matakuliah/preview-pdf', [MatakuliahController::class, 'preview_pdf'])
        ->name('matakuliah.preview_pdf');
    
    // 4. RESOURCE ROUTE MATAKULIAH (SEMUA METHOD KECUALI DESTROY)
    Route::resource('matakuliah', MatakuliahController::class)->except([
        'destroy'
    ]);

});

// ===========================================
// ROUTE UNTUK CEK LIST ROUTE (OPSIONAL - DEVELOPER ONLY)
// ===========================================
if (app()->environment('local')) {
    Route::get('/route-list', function () {
        $routes = Route::getRoutes();
        echo "<h1>Daftar Route</h1>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Method</th><th>URI</th><th>Name</th><th>Action</th></tr>";
        foreach ($routes as $route) {
            echo "<tr>";
            echo "<td>" . implode('|', $route->methods()) . "</td>";
            echo "<td>" . $route->uri() . "</td>";
            echo "<td>" . $route->getName() . "</td>";
            echo "<td>" . $route->getActionName() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    })->middleware('auth');
}

// ===========================================
// AUTH ROUTES (REGISTER, LOGIN, LOGOUT) - DARI LARAVEL BREEZE
// ===========================================
require __DIR__.'/auth.php';