<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): ?object
    {
        return $this->model->all();
    }

    public function create(array $attributes): ?object
    {

        return $this->model->create($attributes);
    }

    public function getById(int $id): ?object
    {
        return $this->model->find($id);
    }

    public function update(array $attributes, int $id): ?object
    {
        $model = $this->model->find($id);

        if(!$model){
            throw new ModelNotFoundException();
        }

        return $model->update($attributes);
    }

    public function destroy(int $id): bool
    {
        $model = $this->model->find($id);

        return $model->delete();
    }

}
