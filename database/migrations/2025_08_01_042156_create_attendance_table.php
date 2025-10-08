<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id(); // id (primary key auto increment)
            $table->unsignedBigInteger('perangkat_id');

            $table->bigInteger('tanggal')->nullable();                // timestamp millis
            $table->bigInteger('absensi_pagi')->nullable();  // timestamp millis
            $table->bigInteger('absensi_sore')->nullable();// timestamp millis
            $table->bigInteger('keterlambatan')->nullable();                // selisih millis
            $table->bigInteger('pulang_cepat')->nullable();               // selisih millis

            // Foreign key ke perangkat_desa
            $table->foreign('user_id')->references('id')->on('perangkat_desa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
