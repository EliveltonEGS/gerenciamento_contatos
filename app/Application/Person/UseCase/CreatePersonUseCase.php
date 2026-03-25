<?php

namespace App\Application\Person\UseCase;

use App\Domain\Person\Services\AvatarService;
use App\Domain\Person\Services\PersonService;
use App\Entities\Person;
use Illuminate\Support\Str;

class CreatePersonUseCase
{
    public function __construct(
        private PersonService $personService,
        private AvatarService $avatarService
    ) {}

    public function execute(Person $person): Person
    {
        $avatar_url = $this->avatarService->getAvatarImage($person->getName());
        $person->setAvatarUrl($avatar_url);

        $currentPerson = $this->personService->create(
            [
                'id' => Str::uuid()->toString(),
                'name' => $person->getName(),
                'avatar_url' => $person->getAvatarUrl()
            ]
        );

        return new Person(
            $currentPerson->id,
            $currentPerson->name,
            $currentPerson->avatar_url
        );
    }
}
