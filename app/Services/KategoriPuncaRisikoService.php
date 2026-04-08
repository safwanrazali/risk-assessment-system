<?php

namespace App\Services;

use App\Models\KategoriPuncaRisiko;

class KategoriPuncaRisikoService extends BaseCrudService
{
    public function __construct(KategoriPuncaRisiko $model)
    {
        parent::__construct($model);
    }
}
