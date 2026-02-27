<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matakuliah;
use App\Models\User;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'nim',
        'nama', 
        'kelas',
        'matakuliah_id',
        'user_id'
    ];
    
    // ==============================
    // RELASI KE MATAKULIAH
    // ==============================
    public function matakuliah()
    {
        return $this->belongsTo(
            Matakuliah::class,
            'matakuliah_id', // foreign key di mahasiswas
            'kode_mk'        // primary key di matakuliahs
        );
    }

    // ==============================
    // RELASI KE USER
    // ==============================
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id', // foreign key di mahasiswas
            'id'       // primary key di users
        );
    }
}