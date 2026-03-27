<?php

namespace App\Repository\Person\Contracts;

use App\Entities\Person;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PersonRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function findById(int $id): ?Person;
    public function save(Person $person): Person;
    public function delete(int $id): void;
    public function all(): Collection;
}
