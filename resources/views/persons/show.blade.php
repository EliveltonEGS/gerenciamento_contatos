@extends('layouts.app')

@section('content')
    <h1>Show Person</h1>
    <div class="mb-3">
        <label>#: {{ $person->getId() }} </label>
    </div>
    <div class="mb-3">
        <label>Name: {{ $person->getName() }}</label>
    </div>
    <div class="mb-3">
        <img 
            src="{{ asset('storage/' . $person->getAvatarUrl()) }}" 
            alt="Avatar"
            width="100"
        >
    </div>
    <div class="mb-3 d-flex gap-2">
        <a 
        href="{{ route('persons.edit', $person->getId()) }}"
        class="btn btn-warning"
        > Edit</a>
        <form action="{{ route('persons.destroy', $person->getId()) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')" type="submit">Delete</button>
        </form>
    </div>
@endsection