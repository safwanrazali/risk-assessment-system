<?php

namespace App\Services;

use App\Models\SubKategoriRisiko;

class SubKategoriRisikoService extends BaseCrudService
{
    public function __construct(SubKategoriRisiko $model)
    {
        parent::__construct($model);
    }
}
