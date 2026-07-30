<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hasil_evaluasi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('desa_id')->constrained('desa');

            // PASTIKAN BARIS INI ADA DI FILE MIGRASI ANDA
            $table->foreignId('perjalanan_dinas_id')
                ->constrained('perjalanan_dinas')
                ->cascadeOnDelete();

            $table->foreignId('user_pelapor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->date('tanggal_evaluasi');
            $table->enum('status', ['DRAFT', 'SELESAI'])->default('DRAFT');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_evaluasi');
    }
};
