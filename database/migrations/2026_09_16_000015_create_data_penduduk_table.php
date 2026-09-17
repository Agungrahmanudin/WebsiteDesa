<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20)->unique();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('status_keluarga', 50)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('agama', 50)->default('Islam');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_penduduk');
    }
};
