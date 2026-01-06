<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('perjalanan_dinas_pegawai', function (Blueprint $table) {
            $table->id();

            $table->foreignId('perjalanan_dinas_id')
                ->constrained('perjalanan_dinas')
                ->cascadeOnDelete();

            $table->foreignId('pegawai_id')
                ->constrained('pegawai')
                ->cascadeOnDelete();

// Optional (siap dipakai nanti)
// $table->string('peran')->nullable();
// $table->decimal('uang_harian', 12, 2)->nullable();

            $table->timestamps();

            $table->unique(
                ['perjalanan_dinas_id', 'pegawai_id'],
                'pd_pegawai_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perjalanan_dinas_pegawai');
    }
};
