@extends('layouts.app')

@section('content')
    <h1>List Contacts</h1>
    
    <div class="mt-2 mb-2">
        <a href="{{ route('contacts.create') }}" class="btn btn-info">New</a>
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
                <th scope="col">DDD</th>
                <th scope="col">Number</th>
                <th scope="col">Email</th>
                <th >Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->person->name }}</td>
                <td>{{ $item->ddd }}</td>
                <td>{{ $item->number }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('contacts.show', $item->id) }}" class="btn btn-warning">Show</a>
                        <a href="{{ route('contacts.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('contacts.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')" type="submit">Delete</button>
                        </form>
                </div>
                </td>
            </tr>
            @empty
            <tr>
            <td colspan="6">Empty contacts.</td> 
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $data->links('pagination::bootstrap-5') }}
@endsection