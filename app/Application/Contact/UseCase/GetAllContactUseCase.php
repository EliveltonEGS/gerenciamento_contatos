<?php

namespace App\Application\Contact\UseCase;

use App\Domain\Contact\Services\ContactService;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllContactUseCase
{
    public function __construct(
        private ContactService $contactService
    ) {}

    public function execute(): LengthAwarePaginator
    {
        return $this->contactService->getAllContactWithPerson();
    }
}
