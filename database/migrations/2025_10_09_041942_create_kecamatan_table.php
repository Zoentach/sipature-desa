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
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->string('kode_kecamatan', 20)->unique();
            $table->string('nama', 100);
            $table->year('tahun_berdiri')->nullable();

            // Tidak ada timestamps karena model menonaktifkannya
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatan');
    }
};
