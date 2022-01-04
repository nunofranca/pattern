<?php

namespace App\Repositories\Post;

interface PostRepositoryInterface
{
        /**
        * @return object|null
        *
        */
       public function getAll(): ?object;

       /**
        * @param array $attributes
        * @return object|null
        *
        */
       public function create(array $attributes): ?object;

       /**
        * @param int $id
        * @return object|null
        */
       public function getById(int $id): ?object;

       /**
        * @param array $attributes
        * @param int $id
        * @return object|null
        */
       public function update(array $attributes, int $id): ?object;

       /**
        * @param int $id
        * @return bool
        */
       public function destroy(int $id): bool;
}
