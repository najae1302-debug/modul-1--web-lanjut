<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Search functionality
        $search = $request->input('search');
        
        $query = Matakuliah::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('kode_mk', 'LIKE', "%{$search}%")
                  ->orWhere('nama_mk', 'LIKE', "%{$search}%");
            });
        }
        
        // Get data with pagination
        $matakuliahs = $query->orderBy('kode_mk')->paginate(10);
        
        return view('matakuliah.index', compact('matakuliahs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matakuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi langsung di controller
    $request->validate([
        'kode_mk' => 'required|unique:matakuliahs,kode_mk|max:10',
        'nama_mk' => 'required|max:100',
        'sks' => 'required|integer|min:1|max:6',
        'semester' => 'required|integer|min:1|max:8'
    ], [
        'kode_mk.required' => 'Kode Mata Kuliah wajib diisi',
        'kode_mk.unique' => 'Kode Mata Kuliah sudah terdaftar',
        'nama_mk.required' => 'Nama Mata Kuliah wajib diisi',
        'sks.required' => 'SKS wajib diisi',
        'sks.min' => 'SKS minimal 1',
        'sks.max' => 'SKS maksimal 6',
        'semester.required' => 'Semester wajib diisi',
        'semester.min' => 'Semester minimal 1',
        'semester.max' => 'Semester maksimal 8'
    ]);
    
    Matakuliah::create($request->all());
    
    return redirect()->route('matakuliah.index')
        ->with('success', 'Data mata kuliah berhasil ditambahkan!');
}
    /**
     * Display the specified resource.
     */
    public function show($kode_mk)
    {
        // Opsional: Detail view
        $matakuliah = Matakuliah::findOrFail($kode_mk);
        return view('matakuliah.show', compact('matakuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($kode_mk)
{
    $matakuliah = Matakuliah::findOrFail($kode_mk);
    return view('matakuliah.edit', compact('matakuliah'));
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kode_mk)
{
    // Validasi TANPA kode_mk
    $request->validate([
        'nama_mk' => 'required|max:100',
        'sks' => 'required|integer|min:1|max:6',
        'semester' => 'required|integer|min:1|max:8',
    ], Matakuliah::$messages);

    $matakuliah = Matakuliah::findOrFail($kode_mk);

    // Update manual (lebih aman daripada $request->all())
    $matakuliah->update([
        'nama_mk' => $request->nama_mk,
        'sks' => $request->sks,
        'semester' => $request->semester,
    ]);

    return redirect()->route('matakuliah.index')
        ->with('success', 'Data mata kuliah berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_mk)
    {
        $matakuliah = Matakuliah::findOrFail($kode_mk);
        $matakuliah->delete();
        
        return redirect()->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus!');
    }
}