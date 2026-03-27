<?php

namespace App\Service\Contact;

use App\DTO\Contact\ContactDTO;
use App\Entities\Contact;
use App\Repository\Contact\Contracts\ContactRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactService
{
    public function __construct(
        private ContactRepositoryInterface $contactRepository
    ) {}

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return $this->contactRepository->paginate($perPage);
    }

    public function findById(int $id): ?Contact
    {
        return $this->contactRepository->findById($id);
    }

    public function save(ContactDTO $dto): Contact
    {
        return $this->contactRepository->save($dto->toEntity());
    }

    public function update(ContactDTO $dto): Contact
    {
        return $this->contactRepository->save($dto->toEntity());
    }

    public function delete(int $id): void
    {
        $this->contactRepository->delete($id);
    }
}
