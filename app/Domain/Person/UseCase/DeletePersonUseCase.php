<?php

namespace App\Domain\Person\UseCase;

use App\Domain\Person\Services\AvatarService;
use App\Domain\Person\Services\PersonService;
use App\Models\Person;

class DeletePersonUseCase
{
    public function __construct(
        private PersonService $personService,
        private AvatarService $avatarService
    ) {}

    public function execute(int $id): bool
    {
        $person = $this->personService->find($id);
        $deleted = $this->personService->delete($id);

        if ($deleted && $person->avatar_url) {
            $this->avatarService->deleteAvatarImage($person->avatar_url);
        }

        return $deleted;
    }
}
