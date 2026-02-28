<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // <-- TAMBAHKAN INI untuk PDF

class MahasiswaController extends Controller
{
    // ==============================
    // TAMPILKAN DATA
    // ==============================
    public function index(Request $request)
    {
        $search = $request->search;

        $mahasiswas = Mahasiswa::with('matakuliah', 'user')
            ->when($search, function ($query) use ($search) {
                $query->where('nim', 'like', "%$search%")
                      ->orWhere('nama', 'like', "%$search%")
                      ->orWhere('kelas', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('mahasiswa.index', compact('mahasiswas', 'search'));
    }

    // ==============================
    // FORM TAMBAH
    // ==============================
    public function create()
    {
        $matakuliahs = Matakuliah::orderBy('nama_mk')->get();
        return view('mahasiswa.create', compact('matakuliahs'));
    }

    // ==============================
    // SIMPAN DATA
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|max:20|unique:mahasiswas,nim',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:20',
            'matakuliah_id' => 'required|exists:matakuliahs,id',
        ]);

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'matakuliah_id' => $request->matakuliah_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    // ==============================
    // FORM EDIT
    // ==============================
    public function edit($nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $matakuliahs = Matakuliah::orderBy('nama_mk')->get();

        return view('mahasiswa.edit', compact('mahasiswa', 'matakuliahs'));
    }

    // ==============================
    // UPDATE DATA
    // ==============================
    public function update(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);

        $request->validate([
            'nama' => 'required|max:100',
            'kelas' => 'required|max:20',
            'matakuliah_id' => 'required|exists:matakuliahs,id',
        ]);

        $mahasiswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'matakuliah_id' => $request->matakuliah_id,
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    // ==============================
    // HAPUS DATA (Manual Email Check)
    // ==============================
    public function destroy($nim)
    {
        // 🔐 Cek email manual
        if (!str_ends_with(auth()->user()->email, '@ikmi.ac.id')) {
            return redirect()->back()
                ->with('error', 'Hanya email @ikmi.ac.id yang bisa menghapus data.');
        }

        // Hapus data
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus!');
    }

    // ==============================
    // FITUR BARU: CETAK PDF (MODUL 4)
    // ==============================
    
    /**
     * Cetak laporan mahasiswa ke PDF (Download)
     */
    public function cetak_pdf()
    {
        // Ambil semua data mahasiswa dengan relasi matakuliah dan user
        $mahasiswa = Mahasiswa::with('matakuliah', 'user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Data tambahan untuk laporan
        $data = [
            'mahasiswa' => $mahasiswa,
            'tanggal_cetak' => now()->format('d F Y'),
            'judul' => 'LAPORAN DATA MAHASISWA',
            'total_mahasiswa' => $mahasiswa->count(),
            'institusi' => 'STMIK IKMI CIREBON'
        ];
        
        // Load view dan generate PDF
        $pdf = Pdf::loadView('mahasiswa.laporan_pdf', $data);
        
        // Set ukuran kertas (A4 landscape agar tabel lebih lebar)
        $pdf->setPaper('A4', 'landscape');
        
        // Download file PDF
        return $pdf->download('laporan-mahasiswa-'.date('Y-m-d').'.pdf');
    }

    /**
     * Preview laporan mahasiswa di browser (Stream)
     */
    public function preview_pdf()
    {
        // Ambil semua data mahasiswa dengan relasi
        $mahasiswa = Mahasiswa::with('matakuliah', 'user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $data = [
            'mahasiswa' => $mahasiswa,
            'tanggal_cetak' => now()->format('d F Y'),
            'judul' => 'LAPORAN DATA MAHASISWA',
            'total_mahasiswa' => $mahasiswa->count(),
            'institusi' => 'STMIK IKMI CIREBON'
        ];
        
        $pdf = Pdf::loadView('mahasiswa.laporan_pdf', $data);
        $pdf->setPaper('A4', 'landscape');
        
        // Tampilkan di browser (stream), bukan download
        return $pdf->stream('laporan-mahasiswa-'.date('Y-m-d').'.pdf');
    }

    /**
     * Cetak laporan berdasarkan filter tertentu (Contoh: per kelas)
     */
    public function cetak_pdf_per_kelas(Request $request)
    {
        $kelas = $request->get('kelas');
        
        $mahasiswa = Mahasiswa::with('matakuliah', 'user')
            ->when($kelas, function ($query) use ($kelas) {
                return $query->where('kelas', $kelas);
            })
            ->orderBy('kelas')
            ->orderBy('nama')
            ->get();
        
        $data = [
            'mahasiswa' => $mahasiswa,
            'tanggal_cetak' => now()->format('d F Y'),
            'judul' => 'LAPORAN DATA MAHASISWA PER KELAS',
            'filter_kelas' => $kelas ?? 'Semua Kelas',
            'total_mahasiswa' => $mahasiswa->count(),
            'institusi' => 'STMIK IKMI CIREBON'
        ];
        
        $pdf = Pdf::loadView('mahasiswa.laporan_pdf_per_kelas', $data);
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('laporan-mahasiswa-per-kelas-'.date('Y-m-d').'.pdf');
    }
}