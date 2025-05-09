<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'category' => 'required',

        ];

        return $rules;
    }
    
     public function messages(): array
    {
        return [
            'category.required' => 'Role is required',
        ];
    }
}
