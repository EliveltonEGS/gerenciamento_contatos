@extends('layouts.app')

@section('content')
    <h1>Show Person</h1>
    <div class="mb-3">
        <label>#: {{ $person->id }} </label>
    </div>
    <div class="mb-3">
        <label>Name: {{ $person->name }}</label>
    </div>
    <div class="mb-3">
        <label>Email: {{ $person->email }}</label>
    </div>
    <div class="mb-3">
        <img 
            src="{{ asset('storage/' . $person->avatar_url) }}" 
            alt="Avatar"
            width="100"
        >
    </div>
    <div class="mb-3 d-flex gap-2">
        <a 
        href="{{ route('persons.edit', $person->id) }}"
        class="btn btn-warning"
        > Edit</a>
        <form action="{{ route('persons.destroy', $person->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')" type="submit">Delete</button>
        </form>
    </div>
@endsection