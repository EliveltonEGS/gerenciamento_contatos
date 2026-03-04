<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contacts.index');
    }

    public function create(): View
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show(string $id): View
    {
        return view('contacts.show');
    }

    public function edit(string $id): View
    {
        return view('contacts.edit');
    }

    public function update(Request $request, string $id)
    {
        dd($request->all(), $id);
    }

    public function destroy(string $id)
    {
        dd($id);
    }
}
