<?php

namespace App\Services\Tesr;

use App\Repositories\Tesr\TesrRepositoryInterface;

class TesrService implements TesrServiceInterface
{
        protected $tesrRepository;

         public function __construct(TesrRepositoryInterface $tesrRepository)
         {
             $this->tesrRepository = $tesrRepository;
         }

         public function getAll()
         {
             return $this->tesrRepository->getAll();
         }

         public function create($attributes)
         {

             return $this->tesrRepository->create($attributes);
         }

         public function show($id)
         {
             return $this->tesrRepository->getById($id);
         }

         public function update($attributes, $id)
         {
             return $this->tesrRepository->update($attributes, $id);
         }

         public function destroy($id)
         {

             return $this->tesrRepository->destroy($id);
         }
}
