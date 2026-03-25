<?php

namespace App\Infrastruture\Repository;

use App\Infrastruture\Repository\Contracts\BaseRepositoyInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseRepositoyInterface
{
    public function __construct(
        private Model $model
    ) {}

    public function all(): LengthAwarePaginator
    {
        return $this->model->orderBy('id')->paginate(5);
    }

    public function find(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): ?Model
    {
        $entity = $this->find($id);

        if (! $entity) {
            return null;
        }

        $entity->update($data);

        return $entity;
    }

    public function delete(int $id): bool
    {
        $entity = $this->find($id);

        return $entity ? (bool) $entity->delete() : false;
    }
}
