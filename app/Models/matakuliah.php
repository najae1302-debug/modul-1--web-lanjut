<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliahs';
    protected $primaryKey = 'kode_mk';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester'
    ];
    
    // TAMBAHKAN INI: Static properties untuk validasi
    public static $rules = [
        'kode_mk' => 'required|unique:matakuliahs,kode_mk|max:10',
        'nama_mk' => 'required|max:100',
        'sks' => 'required|integer|min:1|max:6',
        'semester' => 'required|integer|min:1|max:8'
    ];
    
    public static $messages = [
        'kode_mk.required' => 'Kode Mata Kuliah wajib diisi',
        'kode_mk.unique' => 'Kode Mata Kuliah sudah terdaftar',
        'nama_mk.required' => 'Nama Mata Kuliah wajib diisi',
        'sks.required' => 'SKS wajib diisi',
        'sks.min' => 'SKS minimal 1',
        'sks.max' => 'SKS maksimal 6',
        'semester.required' => 'Semester wajib diisi',
        'semester.min' => 'Semester minimal 1',
        'semester.max' => 'Semester maksimal 8'
    ];
    
    /**
     * Relasi ke Mahasiswa
     */
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'kode_mk', 'kode_mk');
    }
}