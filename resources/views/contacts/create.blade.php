@extends('layouts.app')

@section('content')
    <h1>Create</h1>
    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name: </label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label>Contact:</label>
            <input type="text" name="contact" class="form-control">
        </div>
        <div class="mb-3">
            <label>Email: </label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection