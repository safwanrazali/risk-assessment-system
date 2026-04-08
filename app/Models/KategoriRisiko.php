<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriRisiko extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function subKategoriRisikos(): HasMany
    {
        return $this->hasMany(SubKategoriRisiko::class, 'kategori_id');
    }
}
