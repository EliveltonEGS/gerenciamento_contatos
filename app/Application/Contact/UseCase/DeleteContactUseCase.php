<?php

namespace App\Application\Contact\UseCase;

use App\Domain\Contact\Services\ContactService;

class DeleteContactUseCase
{
    public function __construct(
        private ContactService $contactService
    ) {}

    public function execute(int $id): void
    {
        $this->contactService->delete($id);
    }
}
