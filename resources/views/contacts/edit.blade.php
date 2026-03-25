@extends('layouts.app')

@section('content')
    <h1>Edit Contact</h1>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <form action="{{ route('contacts.update', $contact->getId()) }}" method="POST">
        {{ $contact->getNumber() }}
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Person: </label>
            <select class="form form-control" name="person_id">
                <option value="">--</option>
                @foreach ($persons as $item)
                <option value="{{ $item->id }}" {{ $item->id == $contact->getPerson()->getId() ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            @error('person_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Phone:</label>
            <div class="d-flex gap-2">
                <input 
                    style="width: 80px" 
                    type="text" name="ddd" 
                    class="form-control" 
                    value="{{ old('ddd', $contact->getDdd()) }}" 
                    placeholder="DDD"
                >
                <input 
                    type="text" 
                    name="number" class="form-control" 
                    value="{{ old('number', $contact->getNumber()) }}" 
                    placeholder="Number"
                >
            </div>
            @error('ddd')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @error('number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Email: </label>
            <input 
                type="text" 
                name="email" 
                class="form-control" 
                value="{{ old('email', $contact->getEmail()) }}"
            >
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection