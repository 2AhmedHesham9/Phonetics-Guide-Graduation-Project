<?php

namespace App\Http\Requests\PatientSpecialist;

use Log;
use Illuminate\Foundation\Http\FormRequest;

class SpecialistAddPatientRequest extends FormRequest
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
            // 'specified_id' => 'required|string|exists:patients,specified_id',
            'notes' => 'nullable|string',
            'start_date' => 'required|date|date_format:Y-m-d|before:end_date',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
        ];
    }
    public function messages()
    {
        return [
            'specified_id.exists' => 'The specified ID does not exist in the patients table.',
            'start_date.before' => 'The start date must be before the end date.',
            'end_date.after' => 'The end date must be after the start date.',
        ];
    }
}
