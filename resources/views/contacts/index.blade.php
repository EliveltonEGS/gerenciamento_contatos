@extends('layouts.app')

@section('content')
    <h1>List</h1>
    <div class="mt-2 mb-2">
        <a href="{{ route('contacts.create') }}" class="btn btn-info">New</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Contact</th>
            <th scope="col">Email</th>
            <th >Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>sadf</td>
        <td>
            <div class="d-flex gap-2">
                <a href="{{ route('contacts.show', 1) }}" class="btn btn-warning">Show</a>
                <a href="{{ route('contacts.edit', 1) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('contacts.destroy', 1) }}">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
           </div>
        </td>
        </tr>
    </tbody>
    </table>
@endsection