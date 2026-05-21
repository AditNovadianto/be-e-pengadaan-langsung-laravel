<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sistem', function (Blueprint $table) {
            $table->id('id_sistem');
            $table->string('nama_sistem');
            $table->string('status_sistem');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sistem');
    }
};
