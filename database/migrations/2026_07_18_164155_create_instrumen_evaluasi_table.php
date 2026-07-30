<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('instrumen_evaluasi', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel kelompok_instrumen
            $table->foreignId('kelompok_id')
                ->constrained('kelompok_instrumen')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('uraian_tugas');
            $table->enum('tipe_jawaban', ['KONDISI_FISIK', 'KETERSEDIAAN']);
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instrumen_evaluasi');
    }
};
