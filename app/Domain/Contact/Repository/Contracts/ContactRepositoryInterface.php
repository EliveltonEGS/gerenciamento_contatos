<?php

namespace App\Domain\Contact\Repository\Contracts;

use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;

interface ContactRepositoryInterface
{
    public function getAllContactWithPerson(): LengthAwarePaginator;
}
