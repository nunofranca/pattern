<?php

namespace App\Services\Post;

interface PostServiceInterface
{
    public function getAll();

    public function create($attributes);

    public function show($id);

    public function update($attributes, $id);

    public function destroy($id);
}
