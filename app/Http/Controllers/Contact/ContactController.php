<?php

namespace App\Http\Controllers\Contact;

use App\DTO\Contact\ContactDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactFormRequest;
use App\Service\Contact\ContactService;
use App\Service\Person\PersonService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(
        private ContactService $contactService,
        private PersonService $personService
    ) {}

    public function index(): View
    {
        $data = $this->contactService->paginate(5);
        return view('contacts.index', compact('data'));
    }

    public function create(): View
    {
        $persons = $this->personService->all();
        return view('contacts.create', compact('persons'));
    }

    public function store(ContactFormRequest $request): RedirectResponse
    {
        $dto = ContactDTO::makeFromArray($request->validated());
        $this->contactService->save($dto);

        return redirect()
            ->back()
            ->with('success', 'Contact created successfully.');
    }

    public function show(int $id): View
    {
        $contact = $this->contactService->findById($id);
        return view('contacts.show', compact('contact'));
    }

    public function edit(int $id): View
    {
        $persons = $this->personService->all();
        $contact = $this->contactService->findById($id);
        return view('contacts.edit', compact('contact', 'persons'));
    }

    public function update(ContactFormRequest $request, int $id): RedirectResponse
    {
        $dto = ContactDTO::makeFromArray($request->validated(), $id);
        $this->contactService->update($dto);

        return redirect()->back()->with('success', 'Contact updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->contactService->delete($id);
        return redirect()->route('contacts.index')->with('success', 'Contact deleted.');
    }
}
