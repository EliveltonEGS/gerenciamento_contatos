<?php

namespace App\DTO\Person;

use App\Entities\Person;

class PersonDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly string $name,
        public ?string $avatar_url,
    ) {}

    public static function makeFromArray(array $data, ?string $id = null): self
    {
        return new self(
            id: $id,
            name: $data['name'],
            avatar_url: $data['avatar_url'] ?? null
        );
    }

    public function toEntity(): Person
    {
        return new Person(
            id: $this->id,
            name: $this->name,
            avatar_url: $this->avatar_url
        );
    }
}
