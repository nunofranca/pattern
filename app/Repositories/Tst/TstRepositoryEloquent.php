<?php

namespace App\Repositories\Tst;

use App\Models\Tst;
use App\Repositories\BaseRepository;

class TstRepositoryEloquent extends BaseRepository implements TstRepositoryInterface
{
    public function __construct(Tst $tst)
    {
        parent::__construct($tst);
    }
}
