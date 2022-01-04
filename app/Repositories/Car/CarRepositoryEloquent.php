<?php

namespace App\Repositories\Car;

use App\Models\Car;
use App\Repositories\BaseRepository;

class CarRepositoryEloquent extends BaseRepository implements CarRepositoryInterface
{
    public function __construct(Car $car)
    {
        parent::__construct($car);
    }
}
