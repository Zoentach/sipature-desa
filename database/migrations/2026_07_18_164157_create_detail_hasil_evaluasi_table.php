<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_hasil_evaluasi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hasil_evaluasi_id')
                ->constrained('hasil_evaluasi')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('instrumen_id')
                ->constrained('instrumen_evaluasi')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('nilai_opsi', 20);
            $table->text('catatan')->nullable();
            $table->string('foto_bukti_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_hasil_evaluasi');
    }
};
