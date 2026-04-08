<?php

namespace App\Services;

use App\Models\Sektor;

class SektorService extends BaseCrudService
{
    public function __construct(Sektor $model)
    {
        parent::__construct($model);
    }
}
