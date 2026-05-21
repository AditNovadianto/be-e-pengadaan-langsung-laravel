<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyedia', function (Blueprint $table) {
            $table->id('id_penyedia');
            $table->string('nama_perusahaan');
            $table->string('email_penyedia')->unique();
            $table->string('password_penyedia');
            $table->string('nib');
            $table->unsignedBigInteger('id_sistem');
            
            $table->foreign('id_sistem')->references('id_sistem')->on('sistem')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyedia');
    }
};
