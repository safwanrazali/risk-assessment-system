<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agensi_id')->constrained('agensis')->onDelete('cascade');
            $table->foreignId('jenis_aset_id')->constrained('jenis_asets')->onDelete('restrict');
            $table->string('nama_aset');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
