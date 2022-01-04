<?php

namespace App\Services\Car;

interface CarServiceInterface
{
    public function getAll();

    public function create($attributes);

    public function show($id);

    public function update($attributes, $id);

    public function destroy($id);
}
