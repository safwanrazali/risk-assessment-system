<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPuncaRisiko extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function puncaRisikos(): HasMany
    {
        return $this->hasMany(PuncaRisiko::class);
    }
}
