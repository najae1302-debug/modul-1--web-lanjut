<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function index()
    {
        // Data dikirim ke view welcome_mahasiswa
        // Logika pengiriman data ini dipelajari dengan bantuan AI (DeepSeek)
        // dan telah dipahami serta dikembangkan secara mandiri

        return view('welcome_mahasiswa', [
            'nama' => 'Mahasiswa STMIK IKMI',
            'mata_kuliah' => 'Pemrograman Web Lanjut',
            'kode_mk' => 'WEB302',
            'sks' => 3,
            'dosen' => 'Bpk/Ibu Dosen',
            'semester' => 4,
            'hari' => 'Senin',
            'waktu' => '08.00 - 10.00',
            'ruangan' => 'Lab 2',
            'list_tugas' => [
                'Instalasi Laravel 12',
                'Membuat Route dan Controller',
                'Mengirim Data ke View'
            ],
            'nilai_minimal' => 75,
            'total_pertemuan' => 16
        ]);
    }
}
