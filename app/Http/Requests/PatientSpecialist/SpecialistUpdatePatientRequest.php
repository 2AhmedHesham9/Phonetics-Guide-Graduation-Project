<?php

namespace App\Http\Requests\PatientSpecialist;

use App\Enums\PatientStatus;
use Illuminate\Foundation\Http\FormRequest;

class SpecialistUpdatePatientRequest extends FormRequest
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
            'notes' => 'nullable|string',
            'status'=>['in:' . implode(',', PatientStatus::values())],
            'start_date' => 'date|date_format:Y-m-d|before:end_date',
            'end_date' => 'date|date_format:Y-m-d|after:start_date',
        ];
    }
}
