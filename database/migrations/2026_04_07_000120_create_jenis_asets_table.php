<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_asets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('kategori_punca_risiko_id')->nullable()->constrained('kategori_punca_risikos')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_asets');
    }
};
