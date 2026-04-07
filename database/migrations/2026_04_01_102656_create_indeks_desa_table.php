<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('indeks_desa', function (Blueprint $table) {
            $table->id();
            $table->string('kode_desa', 20)->comment('Kode referensi wilayah desa');
            $table->string('kode_kecamatan', 100);
            $table->year('tahun')->comment('Tahun penilaian IDM');

            // Pilar Penilaian IDM
            $table->decimal('skor_iks', 5, 4)->comment('Indeks Ketahanan Sosial');
            $table->decimal('skor_ike', 5, 4)->comment('Indeks Ketahanan Ekonomi');
            $table->decimal('skor_ikl', 5, 4)->comment('Indeks Ketahanan Lingkungan');

            // Hasil Akhir 
            $table->decimal('skor_idm', 5, 4)->comment('Nilai Total IDM');
            $table->enum('status_desa', [
                'Sangat Tertinggal',
                'Tertinggal',
                'Berkembang',
                'Maju',
                'Mandiri'
            ]);

            $table->timestamps();

            // Mencegah duplikasi: 1 Desa hanya punya 1 data per tahun
            $table->unique(['kode_desa', 'tahun'], 'unique_penilaian_tahunan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indeks_desa');
    }
};
