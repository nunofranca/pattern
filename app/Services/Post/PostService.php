<?php

namespace App\Services\Post;

use App\Repositories\Post\PostRepositoryInterface;

class PostService implements PostServiceInterface
{
        protected $PostRepository;

         public function __construct(PostRepositoryInterface $PostRepository)
         {
             $this->PostRepository = $PostRepository;
         }

         public function getAll()
         {
             return $this->PostRepository->getAll();
         }

         public function create($attributes)
         {

             return $this->PostRepository->create($attributes);
         }

         public function show($id)
         {
             return $this->PostRepository->getById($id);
         }

         public function update($attributes, $id)
         {
             return $this->PostRepository->update($attributes, $id);
         }

         public function destroy($id)
         {

             return $this->PostRepository->destroy($id);
         }
}
