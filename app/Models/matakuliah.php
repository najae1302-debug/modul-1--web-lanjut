<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliahs';

    // WAJIB karena primary key bukan id
    protected $primaryKey = 'kode_mk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester'
    ];

    // Supaya route pakai kode_mk bukan id
    public function getRouteKeyName()
    {
        return 'kode_mk';
    }

    // RELASI
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'matakuliah_id', 'kode_mk');
    }
}
