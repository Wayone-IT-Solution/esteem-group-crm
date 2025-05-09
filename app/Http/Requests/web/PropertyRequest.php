<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'property_title' => 'required|string|max:255',
            'property_type' => 'required',
            'price' => 'required|numeric',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|numeric',
            'address' => 'required|string',
            'total_area' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'documents.*' => 'file|mimes:pdf,doc,docx|max:2048'
        ];
    }
}
