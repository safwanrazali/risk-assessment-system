<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_agensi',
        'no_tel_agensi',
        'website',
        'nama_pic',
        'no_tel_pic',
        'emel_pic',
        'sektor_id',
        'jenis_agensi',
    ];

    public function sektor(): BelongsTo
    {
        return $this->belongsTo(Sektor::class);
    }

    public function asets(): HasMany
    {
        return $this->hasMany(Aset::class);
    }

    public function daftarRisikos(): HasMany
    {
        return $this->hasMany(DaftarRisiko::class);
    }
}
