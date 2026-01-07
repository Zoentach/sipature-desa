<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('regulasi', function (Blueprint $table) {
            $table->id();

            // 🔑 relasi ke jenis regulasi
            $table->foreignId('jenis_regulasi_id')
                ->constrained('jenis_regulasi')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('nomor_regulasi', 50);
            $table->year('tahun');
            $table->string('tentang');

            // 🔑 relasi ke unit kerja
            $table->foreignId('unit_kerja_id')
                ->constrained('unit_kerja')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('file_dokumen'); // path PDF

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regulasi');
    }
};
