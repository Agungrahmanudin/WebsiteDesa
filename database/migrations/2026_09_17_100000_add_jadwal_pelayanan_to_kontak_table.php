<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->string('jadwal_senin_kamis', 50)->nullable()->after('youtube')->default('08.00 - 15.00');
            $table->string('jadwal_jumat', 50)->nullable()->after('jadwal_senin_kamis')->default('08.00 - 11.30');
            $table->string('jadwal_weekend', 50)->nullable()->after('jadwal_jumat')->default('Libur');
        });
    }

    public function down(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->dropColumn(['jadwal_senin_kamis', 'jadwal_jumat', 'jadwal_weekend']);
        });
    }
};
