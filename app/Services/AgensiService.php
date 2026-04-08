<?php

namespace App\Services;

use App\Models\Agensi;

class AgensiService extends BaseCrudService
{
    public function __construct(Agensi $model)
    {
        parent::__construct($model);
    }
}
