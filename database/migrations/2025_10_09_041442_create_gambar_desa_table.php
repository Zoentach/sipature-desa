<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('gambar_desa', function (Blueprint $table) {
            $table->id(); // Primary key otomatis

            $table->string('kode_desa', 20);
            $table->string('nama_file', 255);
            $table->string('keterangan', 255)->nullable();

            // Relasi ke tabel desa (tidak wajib tapi direkomendasikan)
            $table->foreign('kode_desa')
                ->references('kode_desa')
                ->on('desa')
                ->onDelete('cascade');

            // Tidak menggunakan timestamps karena model menonaktifkannya
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_desa');
    }
};
