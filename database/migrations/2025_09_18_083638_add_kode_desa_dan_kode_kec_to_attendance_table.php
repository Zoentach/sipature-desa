<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->string('kode_kecamatan')->nullable()->after('user_id');
            $table->string('kode_desa')->nullable()->after('kode_kecamatan');
        });
    }

    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn(['kode_kecamatan', 'kode_desa']);
        });
    }

};
