<?php

namespace App\Services;

use App\Models\PuncaRisiko;

class PuncaRisikoService extends BaseCrudService
{
    public function __construct(PuncaRisiko $model)
    {
        parent::__construct($model);
    }
}
