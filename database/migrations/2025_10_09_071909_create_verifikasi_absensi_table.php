<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('verifikasi_absensi', function (Blueprint $table) {
            $table->id();

            // relasi ke user
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // kode wilayah (tidak perlu perangkat_desa_id)
            $table->string('kode_kecamatan', 20);
            $table->string('kode_desa', 20);

            // informasi verifikasi
            $table->string('mac_address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifikasi_absensi');
    }
};
