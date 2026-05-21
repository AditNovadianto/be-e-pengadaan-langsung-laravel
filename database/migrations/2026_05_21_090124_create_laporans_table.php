<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->string('nama_laporan');
            $table->string('file_path_laporan');
            $table->unsignedBigInteger('id_pengadaan');
            
            $table->foreign('id_pengadaan')->references('id_pengadaan')->on('pengadaan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
