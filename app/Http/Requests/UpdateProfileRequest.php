<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        return [
            'username' => [
                'bail',
                'required',
                'string',
                'regex:/^[a-z]+[a-z\d]*$/u',
                'max:30',
                'unique:users,username,' . auth()->id() . ',id'
            ],
            'description' => ['bail', 'nullable', 'string'],
            'first_name' => ['bail', 'nullable', 'string', 'max:15'],
            'last_name' => ['bail', 'nullable', 'string', 'max:50'],
        ];
    }
}
