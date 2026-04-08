<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sektor extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function agensis(): HasMany
    {
        return $this->hasMany(Agensi::class);
    }
}
