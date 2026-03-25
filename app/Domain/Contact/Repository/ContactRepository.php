<?php

namespace App\Domain\Contact\Repository;

use App\Domain\Contact\Repository\Contracts\ContactRepositoryInterface;
use App\Infrastruture\Repository\BaseRepository;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    public function __construct(
        private Contact $contact
    ) {
        parent::__construct($contact);
    }

    public function getAllContactWithPerson(): LengthAwarePaginator
    {
        return $this->contact
            ->join('persons AS p', 'p.id', '=', 'contacts.person_id')
            ->orderBy('p.name')
            ->paginate(5);
    }
}
