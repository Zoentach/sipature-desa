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
        Schema::create('desa', function (Blueprint $table) {
            $table->id(); // ID unik otomatis

            $table->string('nama', 100);
            $table->string('kode_desa', 20)->unique();
            $table->string('kode_kecamatan', 20)->nullable();
            $table->year('tahun_berdiri')->nullable();

            // Tidak pakai timestamps karena di model sudah dinonaktifkan
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa');
    }
};
