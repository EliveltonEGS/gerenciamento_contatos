<?php

namespace App\Http\Controllers\Person;

use App\DTO\Person\PersonDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Person\PersonFormRequest;
use App\Service\Person\PersonService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PersonController extends Controller
{
    public function __construct(
        private PersonService $personService
    ) {}

    public function index(Request $request): View
    {
        $persons = $this->personService->paginate(
            name: (string) $request->get('name', ''),
            order: in_array($request->get('order'), ['asc', 'desc']) ? $request->get('order') : 'asc',
            perPage: in_array($request->get('per_page'), [5, 10, 50]) ? $request->get('per_page') : 8
        );

        return view('persons.index', compact('persons'));
    }

    public function create(): View
    {
        return view('persons.create');
    }

    public function store(PersonFormRequest $request): RedirectResponse
    {
        $dto = PersonDTO::makeFromArray($request->validated());
        $this->personService->save($dto);

        return redirect()
            ->back()
            ->with('success', 'Person created successfully.');
    }

    public function show(int $id): View
    {
        $person = $this->personService->findById($id);
        return view('persons.show', compact('person'));
    }

    public function edit(int $id): View
    {
        $person = $this->personService->findById($id);
        return view('persons.edit', compact('person'));
    }

    public function  update(PersonFormRequest $request, int $id): RedirectResponse
    {
        $dto = PersonDTO::makeFromArray($request->validated(), $id);
        $this->personService->update($dto);

        return redirect()
            ->back()
            ->with('success', 'Person updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->personService->delete($id);

        return redirect()
            ->route('persons.index')
            ->with('success', 'Person deleted successfully.');
    }
}
