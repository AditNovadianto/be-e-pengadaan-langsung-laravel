<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id('id_progress');
            $table->string('persentase_progress');
            $table->string('keterangan_progress');
            $table->unsignedBigInteger('id_pengadaan');
            
            $table->foreign('id_pengadaan')->references('id_pengadaan')->on('pengadaan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
