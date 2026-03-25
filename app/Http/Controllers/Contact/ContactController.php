<?php

namespace App\Http\Controllers\Contact;

use App\Application\Contact\DTO\ContactDTO;
use App\Application\Contact\UseCase\CreateContactUseCase;
use App\Application\Contact\UseCase\DeleteContactUseCase;
use App\Application\Contact\UseCase\FindContactUseCase;
use App\Application\Contact\UseCase\GetAllContactUseCase;
use App\Application\Contact\UseCase\UpdateContactUseCase;
use App\Application\Person\UseCase\GetAllPersonUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactFormRequest;
use App\Models\Contact;
use App\Models\Person;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(
        private CreateContactUseCase $createContactUseCase,
        private GetAllContactUseCase $getAllContactUseCase,
        private FindContactUseCase $findContactUseCase,
        private UpdateContactUseCase $updateContactUseCase,
        private DeleteContactUseCase $deleteContactUseCase,

        private GetAllPersonUseCase $getAllPersonUseCase
    ) {}

    public function index(): View
    {
        $data = $this->getAllContactUseCase->execute();
        return view('contacts.index', compact('data'));
    }

    public function create(): View
    {
        $persons = $this->getAllPersonUseCase->execute();
        return view('contacts.create', compact('persons'));
    }

    public function store(ContactFormRequest $request): RedirectResponse
    {
        $dto = ContactDTO::makeFromArray($request->validated());
        $this->createContactUseCase->execute($dto->toEntity());

        return redirect()
            ->back()
            ->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact): View
    {
        $contact = $this->findContactUseCase->execute($contact->id);
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact): View
    {
        $persons = $this->getAllPersonUseCase->execute();
        $contact = $this->findContactUseCase->execute($contact->id);
        return view('contacts.edit', compact('contact', 'persons'));
    }

    public function update(ContactFormRequest $request, Contact $contact): RedirectResponse
    {
        $dto = ContactDTO::makeFromArray($request->validated(), $contact->id);
        $this->updateContactUseCase->execute($dto->toEntity());

        return redirect()->back()->with('success', 'Contact updated.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $this->deleteContactUseCase->execute($contact->id);
        return redirect()->route('contacts.index')->with('success', 'Contact deleted.');
    }
}
