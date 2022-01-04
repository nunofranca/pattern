<?php

namespace App\Services\Tst;

use App\Repositories\Tst\TstRepositoryInterface;

class TstService implements TstServiceInterface
{
        protected $TstRepository;

         public function __construct(TstRepositoryInterface $TstRepository)
         {
             $this->TstRepository = $TstRepository;
         }

         public function getAll()
         {
             return $this->TstRepository->getAll();
         }

         public function create($attributes)
         {

             return $this->TstRepository->create($attributes);
         }

         public function show($id)
         {
             return $this->TstRepository->getById($id);
         }

         public function update($attributes, $id)
         {
             return $this->TstRepository->update($attributes, $id);
         }

         public function destroy($id)
         {

             return $this->TstRepository->destroy($id);
         }
}
