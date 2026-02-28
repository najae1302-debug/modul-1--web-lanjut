<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // <-- TAMBAHKAN INI untuk PDF

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Matakuliah::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('kode_mk', 'LIKE', "%{$search}%")
                  ->orWhere('nama_mk', 'LIKE', "%{$search}%");
            });
        }
        
        $matakuliahs = $query->orderBy('kode_mk')->paginate(10);
        
        return view('matakuliah.index', compact('matakuliahs', 'search'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|unique:matakuliahs,kode_mk|max:10',
            'nama_mk' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8'
        ]);

        Matakuliah::create($request->all());

        return redirect()->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan!');
    }

    public function show(Matakuliah $matakuliah)
    {
        $mahasiswas = $matakuliah->mahasiswas;
        return view('matakuliah.show', compact('matakuliah', 'mahasiswas'));
    }

    public function edit($kode_mk)
    {
        $matakuliah = Matakuliah::findOrFail($kode_mk);
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, $kode_mk)
    {
        $matakuliah = Matakuliah::findOrFail($kode_mk);

        $request->validate([
            'kode_mk' => 'required|unique:matakuliahs,kode_mk,' . $kode_mk . ',kode_mk',
            'nama_mk' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8'
        ]);

        $matakuliah->update($request->all());

        return redirect()->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil diupdate!');
    }

    public function destroy($kode_mk)
    {
        $matakuliah = Matakuliah::findOrFail($kode_mk);
        $matakuliah->delete();
        
        return redirect()->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus!');
    }

    // ===========================================
    // METHOD UNTUK PDF - TAMBAHAN DARI MODUL 4
    // ===========================================
    
    /**
     * Cetak laporan mata kuliah ke PDF (Download)
     */
    public function cetak_pdf()
    {
        // Ambil semua data mata kuliah
        $matakuliah = Matakuliah::orderBy('kode_mk')->get();
        
        // Data untuk dikirim ke view
        $data = [
            'matakuliah' => $matakuliah,
            'tanggal_cetak' => now()->format('d F Y'),
            'total_matakuliah' => $matakuliah->count(),
            'judul' => 'LAPORAN DATA MATA KULIAH',
            'institusi' => 'STMIK IKMI CIREBON'
        ];
        
        // Load view dan generate PDF
        $pdf = Pdf::loadView('matakuliah.laporan_pdf', $data);
        
        // Set ukuran kertas
        $pdf->setPaper('A4', 'portrait');
        
        // Download file PDF
        return $pdf->download('laporan-matakuliah-'.date('Y-m-d').'.pdf');
    }

    /**
     * Preview laporan mata kuliah di browser (Stream)
     */
    public function preview_pdf()
    {
        // Ambil semua data mata kuliah
        $matakuliah = Matakuliah::orderBy('kode_mk')->get();
        
        // Data untuk dikirim ke view
        $data = [
            'matakuliah' => $matakuliah,
            'tanggal_cetak' => now()->format('d F Y'),
            'total_matakuliah' => $matakuliah->count(),
            'judul' => 'LAPORAN DATA MATA KULIAH',
            'institusi' => 'STMIK IKMI CIREBON'
        ];
        
        // Load view dan generate PDF
        $pdf = Pdf::loadView('matakuliah.laporan_pdf', $data);
        
        // Set ukuran kertas
        $pdf->setPaper('A4', 'portrait');
        
        // Tampilkan di browser (stream), bukan download
        return $pdf->stream('laporan-matakuliah-'.date('Y-m-d').'.pdf');
    }

    /**
     * Cetak laporan mata kuliah berdasarkan semester tertentu (Opsional)
     */
    public function cetak_pdf_per_semester(Request $request)
    {
        $semester = $request->get('semester');
        
        $matakuliah = Matakuliah::when($semester, function($query) use ($semester) {
                return $query->where('semester', $semester);
            })
            ->orderBy('semester')
            ->orderBy('kode_mk')
            ->get();
        
        $data = [
            'matakuliah' => $matakuliah,
            'tanggal_cetak' => now()->format('d F Y'),
            'total_matakuliah' => $matakuliah->count(),
            'judul' => 'LAPORAN DATA MATA KULIAH PER SEMESTER',
            'filter_semester' => $semester ?? 'Semua Semester',
            'institusi' => 'STMIK IKMI CIREBON'
        ];
        
        $pdf = Pdf::loadView('matakuliah.laporan_pdf_per_semester', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('laporan-matakuliah-semester-'.($semester ?? 'all').'-'.date('Y-m-d').'.pdf');
    }
}