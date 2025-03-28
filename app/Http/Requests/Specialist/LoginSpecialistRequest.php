<?php

namespace App\Http\Requests\Specialist;

use Illuminate\Foundation\Http\FormRequest;

class LoginSpecialistRequest extends FormRequest
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
            // 'phone_number' => 'required|exists:specialists,phone_number',
            'email' => 'required|email|exists:specialists,email',
            'password' => 'required|string|min:8',
        ];
    }
    public function messages()
    {
        return [
            // 'phone_number.required' => 'The phone_number field is required.',
            // 'phone_number.phone_number' => 'The phone_number must be a valid phone_number address.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
        ];
    }
}
