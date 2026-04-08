<?php

namespace App\Services;

use App\Models\KategoriRisiko;

class KategoriRisikoService extends BaseCrudService
{
    public function __construct(KategoriRisiko $model)
    {
        parent::__construct($model);
    }
}
