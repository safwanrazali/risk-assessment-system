<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aset extends Model
{
    use HasFactory;

    protected $fillable = ['agensi_id', 'jenis_aset_id', 'nama_aset'];

    public function agensi(): BelongsTo
    {
        return $this->belongsTo(Agensi::class);
    }

    public function jenisAset(): BelongsTo
    {
        return $this->belongsTo(JenisAset::class);
    }

    public function daftarRisikos(): HasMany
    {
        return $this->hasMany(DaftarRisiko::class);
    }
}
