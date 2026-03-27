<?php

namespace App\Repository\Contact\Contracts;

use App\Entities\Contact;
use Illuminate\Pagination\LengthAwarePaginator;

interface ContactRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function findById(int $id): ?Contact;
    public function save(Contact $contact): Contact;
    public function delete(int $id): void;
}
