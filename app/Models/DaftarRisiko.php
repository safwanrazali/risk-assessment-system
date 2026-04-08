<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarRisiko extends Model
{
    use HasFactory;

    protected $fillable = [
        'agensi_id',
        'aset_id',
        'kategori_id',
        'sub_kategori_id',
        'risiko_id',
        'kategori_punca_risiko_id',
        'punca_risiko_id',
        'impak',
        'kebarangkalian',
        'skor_risiko',
        'tahap_risiko',
        'kawalan_sedia_ada',
        'pelan_mitigasi',
        'pemilik_risiko',
    ];

    public function agensi(): BelongsTo
    {
        return $this->belongsTo(Agensi::class);
    }

    public function aset(): BelongsTo
    {
        return $this->belongsTo(Aset::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriRisiko::class, 'kategori_id');
    }

    public function subKategori(): BelongsTo
    {
        return $this->belongsTo(SubKategoriRisiko::class, 'sub_kategori_id');
    }

    public function risiko(): BelongsTo
    {
        return $this->belongsTo(Risiko::class);
    }

    public function kategoriPuncaRisiko(): BelongsTo
    {
        return $this->belongsTo(KategoriPuncaRisiko::class);
    }

    public function puncaRisiko(): BelongsTo
    {
        return $this->belongsTo(PuncaRisiko::class);
    }
}
