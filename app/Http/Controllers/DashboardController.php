<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Hitung total mahasiswa
        $totalMahasiswa = Mahasiswa::count();
        
        // Hitung total mata kuliah
        $totalMatakuliah = Matakuliah::count();

        // Ambil 5 mahasiswa terbaru (diurutkan berdasarkan created_at)
        $latestMahasiswa = Mahasiswa::latest()->take(5)->get();
        
        // Ambil data user yang sedang login (opsional, untuk dikirim ke view)
        $user = Auth::user();

        // Kirim semua data ke view
        return view('dashboard', compact(
            'totalMahasiswa',
            'totalMatakuliah',
            'latestMahasiswa',
            'user' // Tambahkan ini
        ));
    }
}