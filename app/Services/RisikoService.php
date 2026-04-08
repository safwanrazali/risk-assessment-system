<?php

namespace App\Services;

use App\Models\Risiko;

class RisikoService extends BaseCrudService
{
    public function __construct(Risiko $model)
    {
        parent::__construct($model);
    }
}
