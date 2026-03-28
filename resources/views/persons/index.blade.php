@extends('layouts.app')

@section('content')
    <h1>List Persons</h1>

    <div class="mt-2 mb-2">
        <form method="GET" action="{{ route('persons.index') }}">
            <div class="d-flex gap-2">
                <label>Per Page:</label>
                <select class="form-control" name="per_page">
                    <option value="">--</option>
                    <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                    <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                </select>
                <label>Order by:</label>
                <select class="form-control" name="order">
                    <option value="">--</option>
                    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descendant</option>
                </select>
                <label>Filter by:</label>
                <input class="form-control" type="text" name="name" value="{{ request('name') }}" placeholder="Pesquisar por nome">
                <button class="btn btn-primary" type="submit">Buscar</button>
                <a href="{{ route('persons.create') }}" class="btn btn-info">New</a>
            </div>
        </form>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th >Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($persons as $person)
                <tr>
                <th scope="row">{{ $person->id }}</th>
                <td>{{ $person->name }}</td>
                <td>
                    <img 
                        src="{{ asset('storage/' . $person->avatar_url) }}" 
                        alt="Avatar"
                        width="50"
                    >
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('persons.show', $person->id) }}" class="btn btn-warning">Show</a>
                        <a href="{{ route('persons.edit', $person->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('persons.destroy', $person->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="4">Empty persons.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $persons->links('pagination::bootstrap-5') }}
@endsection