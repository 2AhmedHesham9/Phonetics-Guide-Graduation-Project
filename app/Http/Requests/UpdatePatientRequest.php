<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            'medical_history' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'date_of_birth' => ['date', 'date_format:Y-m-d'],
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'gender' => ['required', 'string', 'in:' . implode(',', Gender::values())]
            //
        ];
    }
}
