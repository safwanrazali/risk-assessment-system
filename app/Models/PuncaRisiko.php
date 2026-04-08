<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PuncaRisiko extends Model
{
    use HasFactory;

    protected $fillable = ['kategori_punca_risiko_id', 'nama'];

    public function kategoriPuncaRisiko(): BelongsTo
    {
        return $this->belongsTo(KategoriPuncaRisiko::class);
    }

    public function daftarRisikos(): HasMany
    {
        return $this->hasMany(DaftarRisiko::class);
    }
}
