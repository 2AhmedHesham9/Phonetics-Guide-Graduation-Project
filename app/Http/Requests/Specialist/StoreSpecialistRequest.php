<?php

namespace App\Http\Requests\Specialist;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialistRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'years_of_experince' => 'required|integer|min:0',
            'image' => ['nullable', 'image', 'max:2048'],
            'date_of_birth' => ['required', 'date', 'date_format:Y-m-d'],
            'clinic_state' => 'required|string|max:255',
            'clinic_city' => 'required|string|max:255',
            'clinic_street' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:specialists,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'phone_number' => 'required|string|max:20|unique:specialists,phone_number',
            'gender' => ['required', 'string', 'in:' . implode(',', Gender::values())],
            'nid' => 'required|integer|unique:specialists,nid|regex:/^\d{14}$/',

        ];
    }

    public function messages()
    {
        return [

            'password.regex' => 'password',
        ];
    }
}
