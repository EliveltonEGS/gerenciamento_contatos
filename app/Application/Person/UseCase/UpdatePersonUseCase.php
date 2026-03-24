<?php

namespace App\Application\Person\UseCase;

use App\Domain\Person\Services\PersonService;
use App\Entities\Person;

class UpdatePersonUseCase
{
    public function __construct(
        private PersonService $personService
    ) {}

    public function execute(Person $person): Person
    {
        $currentPerson =  $this->personService->update(
            $person->getId(),
            [
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
