<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telp', 100)->nullable();
            $table->string('kelas')->nullable();
            $table->string('jk', 1);
            $table->smallInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_siswa');
    }
};
