<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    
    // TAMBAHKAN INI: Primary key bukan 'id'
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'nim',
        'nama', 
        'kelas',
        'matakuliah',
        'kode_mk'
    ];
    
    /**
     * Relasi ke Mata Kuliah
     */
    public function mataKuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_mk', 'kode_mk');
    }
}