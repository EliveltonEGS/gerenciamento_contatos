<?php

namespace App\DTO\Contact;

use App\Entities\Contact;
use App\Entities\Person;

class ContactDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly string $ddd,
        public readonly string $number,
        public readonly string $email,
        public readonly int $person_id,
    ) {}

    public static function makeFromArray(array $data, ?string $id = null): self
    {
        return new self(
            id: $id,
            ddd: $data['ddd'],
            number: $data['number'],
            email: $data['email'],
            person_id: $data['person_id'],
        );
    }

    public function toEntity(): Contact
    {
        return new Contact(
            id: $this->id,
            ddd: $this->ddd,
            number: $this->number,
            email: $this->email,
            person: new Person(id: $this->person_id)
        );
    }
}
