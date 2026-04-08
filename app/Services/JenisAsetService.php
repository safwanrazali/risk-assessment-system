<?php

namespace App\Services;

use App\Models\JenisAset;

class JenisAsetService extends BaseCrudService
{
    public function __construct(JenisAset $model)
    {
        parent::__construct($model);
    }
}
