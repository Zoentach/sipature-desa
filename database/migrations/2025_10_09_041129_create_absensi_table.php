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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id(); // id absensi dibuat otomatis oleh database

            $table->string('kode_desa', 20)->nullable();
            $table->string('kode_kecamatan', 20)->nullable();

            // perangkat_id hanya disimpan sebagai kolom biasa (bukan foreign key)
            $table->unsignedBigInteger('perangkat_id')->nullable();

            $table->date('tanggal');
            $table->time('absensi_pagi')->nullable();
            $table->time('absensi_sore')->nullable();

            $table->integer('keterlambatan')->nullable();
            $table->integer('pulang_cepat')->nullable();

            $table->string('gambar_pagi')->nullable();
            $table->string('gambar_sore')->nullable();

            $table->enum('keterangan', ['Hadir', 'Izin', 'Sakit', 'Cuti', 'Tugas Luar'])
                ->default('Hadir');
            $table->string('lampiran')->nullable();
            $table->enum('status_kehadiran', ['Pending', 'Ditolak', 'Disetujui'])
                ->default('Disetujui');

            // Kalau kamu ingin created_at dan updated_at otomatis dari Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
