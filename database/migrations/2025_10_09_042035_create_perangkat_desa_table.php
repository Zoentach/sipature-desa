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
        Schema::create('perangkat_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nipd', 30)->nullable()->unique();
            $table->string('nik', 30)->nullable()->unique();
            $table->string('kode_kecamatan', 20)->nullable();
            $table->string('kode_desa', 20)->nullable();
            $table->string('kode_jabatan', 10)->nullable();
            $table->string('grup_jabatan', 50)->nullable();

            $table->date('mulai')->nullable();
            $table->date('berakhir')->nullable();

            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();

            $table->unsignedBigInteger('sk_id')->nullable();
            $table->unsignedBigInteger('pendidikan_id')->nullable();

            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();

            $table->enum('agama', [
                'Islam',
                'Kristen Protestan',
                'Katolik',
                'Hindu',
                'Buddha',
                'Konghucu',
            ])->nullable();

            $table->string('no_telp', 20)->nullable();

            $table->enum('status_jabatan', [
                'Definitif',
                'Pelaksana Tugas',
                'Pelaksana Harian',
                'Kosong'
            ])->nullable();

            $table->enum('status_keaktifan', [
                'Aktif',
                'Nonaktif',
                'Pensiun',
                'Berhenti'
            ])->nullable();
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat_desa');
    }
};
