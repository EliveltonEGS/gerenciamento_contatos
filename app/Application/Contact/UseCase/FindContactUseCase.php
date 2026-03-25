<?php

namespace App\Application\Contact\UseCase;

use App\Domain\Contact\Services\ContactService;
use App\Entities\Contact;
use App\Entities\Person;

class FindContactUseCase
{
    public function __construct(
        private ContactService $contactService
    ) {}

    public function execute(int $id): Contact
    {
        $contact = $this->contactService->find($id);

        return new Contact(
            $contact->id,
            $contact->ddd,
            $contact->number,
            $contact->email,
            new Person(id: $contact->person->id, name: $contact->person->name)
        );
    }
}
