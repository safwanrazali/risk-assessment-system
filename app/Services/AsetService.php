<?php

namespace App\Services;

use App\Models\Aset;

class AsetService extends BaseCrudService
{
    public function __construct(Aset $model)
    {
        parent::__construct($model);
    }
}
