<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kelompok_instrumen', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel unit_kerja
            $table->foreignId('unit_kerja_id')
                ->constrained('unit_kerja')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('nama_kelompok');
            $table->integer('urutan')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelompok_instrumen');
    }
};
