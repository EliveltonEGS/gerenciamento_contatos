@extends('layouts.app')

@section('content')
    <h1>Show Contact</h1>
    <div class="mb-3">
        <label>Name: {{ $contact->getPerson()->getName() }} </label>
    </div>
    <div class="mb-3">
        <label>Name: {{ $contact->getDdd() }}</label>
    </div>
    <div class="mb-3">
        <label>Contact: {{ $contact->getNumber() }}</label>
    </div>
    <div class="mb-3">
        <label>Email: Contact: {{ $contact->getEmail() }}</label>
    </div>
    <div class="mb-3 d-flex gap-2">
        <a 
        href="{{ route('contacts.edit', $contact->getId()) }}"
        class="btn btn-warning"
        > Edit</a>
        <form action="{{ route('contacts.destroy', $contact->getId()) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')" type="submit">Delete</button>
        </form>
    </div>
@endsection