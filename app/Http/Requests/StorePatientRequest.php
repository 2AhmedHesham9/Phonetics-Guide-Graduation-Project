<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'medical_history' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'date_of_birth' => ['required', 'date', 'date_format:Y-m-d'],
            'state' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'street' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:patients,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'gender' => ['required', 'string', 'in:' . implode(',', Gender::values())],


        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'الاسم الاول مطلوب',
            'first_name.string' => 'First name must be a valid text.',
            'first_name.max' => 'First name cannot exceed 255 characters.',

            'last_name.required' => 'Last name is required.',
            'last_name.string' => 'Last name must be a valid text.',
            'last_name.max' => 'Last name cannot exceed 255 characters.',

            'medical_history.required' => 'Medical history is required.',
            'medical_history.string' => 'Medical history must be a valid text.',

            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.date' => 'Date of birth must be a valid date.',
            'date_of_birth.date_format' => 'The date of birth must be in the format YYYY-MM-DD.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',

            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',




            'gender.in' => 'Invalid gender selected.',

        ];
    }
}
