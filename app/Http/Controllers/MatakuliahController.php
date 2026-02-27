<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

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
}
