<?php

namespace App\Service\Person;

use App\DTO\Person\PersonDTO;
use App\Entities\Person;
use App\Repository\Person\Contracts\PersonRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PersonService
{
    public function __construct(
        private PersonRepositoryInterface $personRepository,
        private AvatarService $avatarService
    ) {}

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return $this->personRepository->paginate($perPage);
    }

    public function findById(int $id): ?Person
    {
        return $this->personRepository->findById($id);
    }

    public function save(PersonDTO $dto): Person
    {
        $dto->avatar_url = $this->avatarService->getAvatarImage($dto->name);

        return $this->personRepository->save($dto->toEntity());
    }

    public function update(PersonDTO $dto): Person
    {
        return $this->personRepository->save($dto->toEntity());
    }

    public function delete(int $id): void
    {
        $person = $this->personRepository->findById($id);
        $this->personRepository->delete($id);

        if ($person->getAvatarUrl()) {
            $this->avatarService->deleteAvatarImage($person->getAvatarUrl());
        }
    }

    public function all(): Collection
    {
        return $this->personRepository->all();
    }
}
