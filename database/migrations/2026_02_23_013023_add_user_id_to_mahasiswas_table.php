<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            // Tambahkan kolom user_id yang terhubung dengan tabel users
            $table->foreignId('user_id')
                  ->after('id') // letakkan setelah kolom id (opsional)
                  ->constrained() // otomatis mengacu ke tabel users
                  ->onDelete('cascade'); // kalau user dihapus, data mahasiswa ikut terhapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            // Drop foreign key dulu
            $table->dropForeign(['user_id']);
            // Hapus kolom user_id
            $table->dropColumn('user_id');
        });
    }
};