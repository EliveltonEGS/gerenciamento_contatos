<?php

namespace App\Repository\Person;

use App\Entities\Person;
use App\Repository\Person\Contracts\PersonRepositoryInterface;
use App\Models\Person as PersonModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PersonRepository implements PersonRepositoryInterface
{

    public function __construct(
        private PersonModel $personModel
    ) {}

    public function paginate(string $name = '', string $order = '', int $perPage = 15): LengthAwarePaginator
    {
        return $this->personModel
            ->when($name, fn ($q) =>
                $q->where('name', 'like', "%{$name}%")
            )
            ->orderBy('name', $order)
            ->paginate($perPage);
    }

    public function findById(int $id): ?Person
    {
        $model = $this->personModel->find($id);

        return $model ? new Person(
            id: $model->id,
            name: $model->name,
            avatar_url: $model->avatar_url
        ) : null;
    }

    public function save(Person $person): Person
    {
        $model = $person->getId()
            ? $this->personModel->findOrFail($person->getId())
            : new PersonModel();

        $model->fill([
            'name' => $person->getName(),
            'avatar_url' => $person->getAvatarUrl()
        ]);

        $model->save();

        return new Person(
            id: $model->id,
            name: $model->name,
            avatar_url: $model->avatar_url
        );
    }

    public function delete(int $id): void
    {
        $model = $this->personModel->find($id);

        if (!$model) {
            return;
        }

        $model->delete();
    }

    public function all(): Collection
    {
        return $this->personModel->orderBy('name')->get();
    }
}
