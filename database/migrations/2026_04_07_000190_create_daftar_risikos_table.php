<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daftar_risikos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agensi_id')->constrained('agensis')->onDelete('cascade');
            $table->foreignId('aset_id')->constrained('asets')->onDelete('restrict');
            $table->foreignId('kategori_id')->constrained('kategori_risikos')->onDelete('restrict');
            $table->foreignId('sub_kategori_id')->constrained('sub_kategori_risikos')->onDelete('restrict');
            $table->foreignId('risiko_id')->constrained('risikos')->onDelete('restrict');
            $table->foreignId('kategori_punca_risiko_id')->constrained('kategori_punca_risikos')->onDelete('restrict');
            $table->foreignId('punca_risiko_id')->constrained('punca_risikos')->onDelete('restrict');
            $table->unsignedTinyInteger('impak');
            $table->unsignedTinyInteger('kebarangkalian');
            $table->unsignedSmallInteger('skor_risiko');
            $table->string('tahap_risiko');
            $table->text('kawalan_sedia_ada')->nullable();
            $table->text('pelan_mitigasi')->nullable();
            $table->string('pemilik_risiko')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daftar_risikos');
    }
};
