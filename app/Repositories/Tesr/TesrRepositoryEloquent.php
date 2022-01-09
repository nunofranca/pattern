<?php

namespace App\Repositories\Tesr;

use App\Models\Tesr;
use App\Repositories\BasesRepository;

class TesrRepositoryEloquent extends BasesRepository implements TesrRepositoryInterface
{
    public function __construct(Tesr $tesr)
    {
        parent::__construct($tesr);
    }
}
