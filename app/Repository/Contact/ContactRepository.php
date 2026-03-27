<?php

namespace App\Repository\Contact;

use App\Entities\Contact;
use App\Entities\Person;
use App\Models\Contact as ContactModel;
use App\Repository\Contact\Contracts\ContactRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactRepository implements ContactRepositoryInterface
{

    public function __construct(
        private ContactModel $contactModel
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->contactModel->paginate($perPage);
    }

    public function findById(int $id): ?Contact
    {
        $model = $this->contactModel->with('person')->find($id);

        return $model ? new Contact(
            id: $model->id,
            ddd: $model->ddd,
            number: $model->number,
            email: $model->email,
            person: new Person(
                id: $model->person->id,
                name: $model->person->name,
                avatar_url: $model->person->avatar_url
            )
        ) : null;
    }

    public function save(Contact $contact): Contact
    {
        $model = $contact->getId()
            ? $this->contactModel->findOrFail($contact->getId())
            : new ContactModel();

        $model->fill([
            'person_id' => $contact->getPerson()->getId(),
            'ddd' => $contact->getDdd(),
            'number' => $contact->getNumber(),
            'email' => $contact->getEmail()
        ]);

        $model->save();

        return new Contact(
            id: $model->id,
            ddd: $model->ddd,
            number: $model->number,
            email: $model->email,
            person: new Person(
                id: $model->person->id,
                name: $model->person->name,
                avatar_url: $model->person->avatar_url
            )
        );
    }

    public function delete(int $id): void
    {
        $model = $this->contactModel->find($id);

        if (!$model) {
            return;
        }

        $model->delete();
    }
}
