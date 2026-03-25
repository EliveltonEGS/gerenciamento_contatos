<?php

namespace App\Application\Contact\UseCase;

use App\Domain\Contact\Services\ContactService;
use App\Entities\Contact;
use Illuminate\Support\Str;

class CreateContactUseCase
{
    public function __construct(
        private ContactService $contactService
    ) {}

    public function execute(Contact $contact): void
    {
        $this->contactService->create([
            'id' => Str::uuid()->toString(),
            'person_id' => $contact->getPerson()->getId(),
            'ddd' => $contact->getDdd(),
            'number' => $contact->getNumber(),
            'email' => $contact->getEmail()
        ]);
    }
}
