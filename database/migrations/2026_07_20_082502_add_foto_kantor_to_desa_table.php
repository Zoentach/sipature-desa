<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('desa', function (Blueprint $table) {
            // Menambahkan kolom foto_kantor, boleh kosong (nullable)
            $table->string('foto_kantor')->nullable()->after('tahun_berdiri');
        });
    }

    public function down(): void
    {
        Schema::table('desa', function (Blueprint $table) {
            $table->dropColumn('foto_kantor');
        });
    }
};
