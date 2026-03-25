<?php

namespace App\Entities;

class Contact
{
    private ?string $id;
    private string $ddd;
    private int $number;
    private string $email;
    private Person $person;

    public function __construct(
        ?string $id,
        string $ddd,
        int $number,
        string $email,
        Person $person
    ) {
        $this->id = $id;
        $this->ddd = $ddd;
        $this->number = $number;
        $this->email = $email;
        $this->person = $person;
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDdd(): string
    {
        return $this->ddd;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function setDdd(string $ddd): void
    {
        $this->ddd = $ddd;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }
}
