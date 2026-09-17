<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->text('visi')->nullable()->after('hero_image');
            $table->text('misi')->nullable()->after('visi');
            $table->text('sejarah')->nullable()->after('misi');
        });
    }

    public function down(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->dropColumn(['visi', 'misi', 'sejarah']);
        });
    }
};