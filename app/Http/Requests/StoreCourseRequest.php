<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'title' => ['bail', 'required', 'unique:courses,title', 'string', 'max:255'],
            'introduction' => ['bail', 'required', 'string', 'max:255'],
            'price' => ['bail', 'required', 'decimal:0,2'],
            'discount' => ['bail', 'nullable', 'integer', 'between:0,100'],
            'category_id' => ['bail', 'required', 'integer', 'exists:categories,id'],
            'languages' => ['bail', 'required', 'integer', 'digits_between:1,2'],
            'level' => ['bail', 'required', 'integer', 'digits_between:1,3'],
            'description' => ['bail', 'required', 'string'],
            'learns_description' => ['bail', 'required', 'string'],
            'requirements_description' => ['bail', 'required', 'string']
        ];
    }
}
