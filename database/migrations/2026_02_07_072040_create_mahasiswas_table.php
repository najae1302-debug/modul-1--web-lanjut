<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {

            $table->string('nim')->primary();
            $table->string('nama');
            $table->string('kelas');

            // Foreign key pakai kode_mk
            $table->string('matakuliah_id');

            $table->foreign('matakuliah_id')
                  ->references('kode_mk')
                  ->on('matakuliahs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
