<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // TAMBAHKAN INI:
    protected $fillable = ['nim', 'nama', 'kelas', 'matakuliah'];
    
    // Jika pakai primary key custom (nim sebagai primary key)
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';
}