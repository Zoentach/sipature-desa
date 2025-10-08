<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn('image'); // hapus kolom lama
            $table->string('gambar_pagi')->nullable()->after('pulang_cepat');
            $table->string('gambar_sore')->nullable()->after('gambar_pagi');
        });
    }

    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn(['gambar_pagi', 'gambar_sore']);
            $table->string('image')->nullable()->after('pulang_cepat');
        });
    }
};
