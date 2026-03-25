<?php

namespace App\Entities;

class Person
{
    private ?string $id;
    private ?string $name;
    private ?string $avatar_url;

    public function __construct(
        ?string $id = null,
        ?string $name = null,
        ?string $avatar_url = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->avatar_url = $avatar_url;
    }

    public function getId(): ?string
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

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAvatarUrl(?string $avatar_url): void
    {
        $this->avatar_url = $avatar_url;
    }
}
