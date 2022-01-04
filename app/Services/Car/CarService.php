<?php

namespace App\Services\Car;

use App\Repositories\Car\CarRepositoryInterface;

class CarService implements CarServiceInterface
{
        protected $CarRepository;

         public function __construct(CarRepositoryInterface $CarRepository)
         {
             $this->CarRepository = $CarRepository;
         }

         public function getAll()
         {
             return $this->CarRepository->getAll();
         }

         public function create($attributes)
         {

             return $this->CarRepository->create($attributes);
         }

         public function show($id)
         {
             return $this->CarRepository->getById($id);
         }

         public function update($attributes, $id)
         {
             return $this->CarRepository->update($attributes, $id);
         }

         public function destroy($id)
         {

             return $this->CarRepository->destroy($id);
         }
}
