<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_agensi');
            $table->string('no_tel_agensi')->nullable();
            $table->string('website')->nullable();
            $table->string('nama_pic')->nullable();
            $table->string('no_tel_pic')->nullable();
            $table->string('emel_pic')->nullable();
            $table->foreignId('sektor_id')->constrained('sektors')->onDelete('cascade');
            $table->string('jenis_agensi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agensis');
    }
};
