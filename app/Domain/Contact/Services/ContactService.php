<?php

namespace App\Domain\Contact\Services;

use App\Domain\Contact\Repository\Contracts\ContactRepositoryInterface;
use App\Infrastruture\Service\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactService extends BaseService
{
    public function __construct(
        private ContactRepositoryInterface $contactRepository
    ) {
        parent::__construct($this->contactRepository);
    }

    public function getAllContactWithPerson(): LengthAwarePaginator
    {
        return $this->contactRepository->getAllContactWithPerson();
    }
}
