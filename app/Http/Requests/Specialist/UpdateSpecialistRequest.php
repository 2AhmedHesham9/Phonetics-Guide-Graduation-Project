<?php

namespace App\Http\Requests\Specialist;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class UpdateSpecialistRequest extends FormRequest
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
            'years_of_experince' => 'integer|min:0',
            'image' => ['nullable', 'image', 'max:2048'],
            'date_of_birth' => ['date', 'date_format:Y-m-d'],
            'clinic_state' => 'nullable|string|max:255',
            'clinic_city' => 'nullable|string|max:255',
            'clinic_street' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'gender' => ['required','string', 'in:' . implode(',', Gender::values())]
            // 'nid' => 'integer|unique:specialists,nid|regex:/^\d{14}$/',
            // 'email' => 'unique:specialists,email,' . $request->user()->id
        ];
    }
    public function messages()
    {
        return[
           //
        ];
    }
}
