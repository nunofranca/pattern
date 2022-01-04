<?php

namespace App\Services\Tst;

interface TstServiceInterface
{
    public function getAll();

    public function create($attributes);

    public function show($id);

    public function update($attributes, $id);

    public function destroy($id);
}
