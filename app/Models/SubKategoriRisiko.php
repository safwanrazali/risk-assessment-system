<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubKategoriRisiko extends Model
{
    use HasFactory;

    protected $fillable = ['kategori_id', 'nama'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriRisiko::class, 'kategori_id');
    }

    public function risikos(): HasMany
    {
        return $this->hasMany(Risiko::class);
    }
}
