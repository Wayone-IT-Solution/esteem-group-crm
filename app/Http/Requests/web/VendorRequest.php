<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            // Basic Information
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'password' => 'required|string|min:6',

            // Restaurant Details
            'restaurant_name' => 'required|unique:shops',
            'cuisine_type' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'state' => 'required|string|max:500',
            'city' => 'required|string|max:500',
            'zip_code' => 'required|string|max:500',

            // Bank Details
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|numeric',
            'ifsc_code' => 'nullable|string|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'upi_id' => 'nullable|string|email',

            // File Uploads
            'fssai_license' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'gst_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'pan_card' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already registered',
            'phone.required' => 'Phone number is required',
            'phone.unique' => 'Phone number is already in use',
            'phone.digits' => 'Phone number must be exactly 10 digits',
            'password.min' => 'Password must be at least 6 characters',
            'opening_time.date_format' => 'Opening time format should be HH:MM',
            'closing_time.after' => 'Closing time must be after opening time',
            'ifsc_code.regex' => 'Invalid IFSC code format',
            'upi_id.email' => 'Invalid UPI ID format',
        ];
    }
}
