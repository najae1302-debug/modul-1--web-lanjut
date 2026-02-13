<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom kode_mk ke tabel mahasiswas
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->string('kode_mk', 10)->nullable()->after('matakuliah');
            
            // Foreign key constraint (opsional)
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliahs')
                  ->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            // Hapus foreign key dulu
            $table->dropForeign(['kode_mk']);
            // Hapus kolom
            $table->dropColumn('kode_mk');
        });
    }
};