<?php

namespace App\Application\Person\DTO;

class PersonCreateDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public ?string $avatar_url,
    ) {}

    public static function makeFromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            avatar_url: $data['avatar_url'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'email' => $this->email,
            'avatar_url' => $this->avatar_url
        ];
    }
}
