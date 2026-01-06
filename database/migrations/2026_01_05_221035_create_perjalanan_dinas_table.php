<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('perjalanan_dinas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jenis_perjalanan_id')
                ->constrained('jenis_perjalanan')
                ->cascadeOnDelete();

            $table->string('nomor_spt');
            $table->text('maksud_tujuan');

            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->integer('lama_hari');

            $table->enum('status', ['draft', 'disetujui', 'selesai'])
                ->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perjalanan_dinas');
    }
};
