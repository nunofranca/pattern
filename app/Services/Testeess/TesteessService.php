<?php

namespace App\Services\Testeess;

use App\Repositories\Testeess\TesteessRepositoryInterface;

class TesteessService implements TesteessServiceInterface
{
        protected $testeessRepository;

         public function __construct(TesteessRepositoryInterface $testeessRepository)
         {
             $this->testeessRepository = $testeessRepository;
         }

         public function getAll()
         {
             return $this->testeessRepository->getAll();
         }

         public function create($attributes)
         {

             return $this->testeessRepository->create($attributes);
         }

         public function show($id)
         {
             return $this->testeessRepository->getById($id);
         }

         public function update($attributes, $id)
         {
             return $this->testeessRepository->update($attributes, $id);
         }

         public function destroy($id)
         {

             return $this->testeessRepository->destroy($id);
         }
}
