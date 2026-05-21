<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->id('id_pengadaan');
            $table->string('nama_pengadaan');
            $table->string('pagu_anggaran');
            $table->string('nilai_penawaran')->nullable();
            $table->string('nilai_kontrak')->nullable();
            $table->string('status_pengadaan');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_penyedia');
            
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_penyedia')->references('id_penyedia')->on('penyedia')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengadaan');
    }
};
