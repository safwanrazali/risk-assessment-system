<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('punca_risikos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_punca_risiko_id')->constrained('kategori_punca_risikos')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('punca_risikos');
    }
};
