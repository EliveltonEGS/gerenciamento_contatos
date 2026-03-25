<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $contact = $this->route('contact');

        return [
            'person_id' => ['required', 'exists:persons,id'],

            'ddd' => [
                'required',
                'digits:2'
            ],

            'number' => [
                'required',
                'digits:9',
                Rule::unique('contacts', 'number')->ignore($contact),
            ],

            'email' => [
                'required',
                'email',
                'max:80',
                Rule::unique('contacts', 'email')->ignore($contact),
            ],
        ];
    }
}
