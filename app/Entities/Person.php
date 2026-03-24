<?php

namespace App\Entities;

class Person
{
    public function __construct(
        private ?int $id,
        private string $name,
        private ?string $avatar_url,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAvatarUrl(string $avatar_url): void
    {
        $this->avatar_url = $avatar_url;
    }
}
