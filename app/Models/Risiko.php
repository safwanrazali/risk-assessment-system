<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Risiko extends Model
{
    use HasFactory;

    protected $fillable = ['sub_kategori_risiko_id', 'nama'];

    public function subKategoriRisiko(): BelongsTo
    {
        return $this->belongsTo(SubKategoriRisiko::class);
    }

    public function daftarRisikos(): HasMany
    {
        return $this->hasMany(DaftarRisiko::class);
    }
}
