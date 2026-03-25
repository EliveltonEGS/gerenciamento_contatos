@extends('layouts.app')

@section('content')
    <h1>Edit Person</h1>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <form action="{{ route('persons.update', $person->getId()) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="{{ old('name', $person->getName()) }}"
            >
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection