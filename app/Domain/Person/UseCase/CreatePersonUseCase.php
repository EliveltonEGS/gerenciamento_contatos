<?php

namespace App\Domain\Person\UseCase;

use App\Application\Person\DTO\PersonCreateDTO;
use App\Domain\Person\Services\AvatarService;
use App\Domain\Person\Services\PersonService;
use App\Models\Person;

class CreatePersonUseCase
{
    public function __construct(
        private PersonService $personService,
        private AvatarService $avatarService
    ) {}

    public function execute(PersonCreateDTO $dto): Person
    {
        $dto->avatar_url = $this->avatarService->getAvatarImage($dto->name);
        return $this->personService->create($dto->toArray());
    }
}
