<?php

namespace App\Services;

use App\Models\DaftarRisiko;

class DaftarRisikoService extends BaseCrudService
{
    public function __construct(DaftarRisiko $model)
    {
        parent::__construct($model);
    }
}
