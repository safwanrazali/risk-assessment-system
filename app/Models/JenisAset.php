<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisAset extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kategori_punca_risiko_id'];

    public function kategoriPuncaRisiko(): BelongsTo
    {
        return $this->belongsTo(KategoriPuncaRisiko::class);
    }

    public function asets(): HasMany
    {
        return $this->hasMany(Aset::class);
    }
}
