<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

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
}