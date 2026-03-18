<?php

namespace App\Http\Controllers\Person;

use App\Application\Person\DTO\PersonCreateDTO;
use App\Application\Person\DTO\PersonUpdateDTO;
use App\Domain\Person\UseCase\CreatePersonUseCase;
use App\Domain\Person\UseCase\DeletePersonUseCase;
use App\Domain\Person\UseCase\FindPersonUseCase;
use App\Domain\Person\UseCase\GetAllPersonUseCase;
use App\Domain\Person\UseCase\UpdatePersonUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Person\PersonFormRequest;
use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PersonController extends Controller
{
    public function __construct(
        private GetAllPersonUseCase $getAllPersonUsecase,
        private CreatePersonUseCase $createPersonUseCase,
        private FindPersonUseCase $findPersonUseCase,
        private UpdatePersonUseCase $updatePersonUseCase,
        private DeletePersonUseCase $deletePersonUseCase
    ) {}

    public function index(): View
    {
        $persons = $this->getAllPersonUsecase->execute();
        return view('persons.index', compact('persons'));
    }

    public function create(): View
    {
        return view('persons.create');
    }

    public function store(PersonFormRequest $request): RedirectResponse
    {
        try {
            $dto = PersonCreateDTO::makeFromArray($request->validated());
            $this->createPersonUseCase->execute($dto);

            return redirect()
                ->back()
                ->with('success', 'Person created successfully.');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function show(Person $person): View
    {
        $person = $this->findPersonUseCase->execute($person->id);
        return view('persons.show', compact('person'));
    }

    public function edit(Person $person): View
    {
        $person = $this->findPersonUseCase->execute($person->id);
        return view('persons.edit', compact('person'));
    }

    public function  update(PersonFormRequest $request, Person $person): RedirectResponse
    {
        try {
            $dto = PersonUpdateDTO::makeFromArray($request->validated(), $person->id);
            $this->updatePersonUseCase->execute($dto);

            return redirect()
                ->back()
                ->with('success', 'Person updated successfully.');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(Person $person): RedirectResponse
    {
        $this->deletePersonUseCase->execute($person->id);

        return redirect()
            ->route('persons.index')
            ->with('success', 'Person deleted successfully.');
    }
}
