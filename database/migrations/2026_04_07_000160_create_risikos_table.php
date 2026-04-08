<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('risikos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_kategori_risiko_id')->constrained('sub_kategori_risikos')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risikos');
    }
};
