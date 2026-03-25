<?php

namespace App\Application\Person\UseCase;

use App\Domain\Person\Services\PersonService;
use App\Entities\Person;

class FindPersonUseCase
{
    public function __construct(
        private PersonService $personService
    ) {}

    public function execute(int $id): Person
    {
        $person = $this->personService->find($id);

        return new Person(
            $person->id,
            $person->name,
            $person->avatar_url
        );
    }
}
