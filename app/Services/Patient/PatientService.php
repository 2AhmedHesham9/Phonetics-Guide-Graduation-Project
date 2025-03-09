<?php

namespace App\Services\Patient;

use App\Models\Patient;
use App\Http\Requests\UpdatePatientRequest;

class PatientService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function UpdateProfile(UpdatePatientRequest $request,  $id)
    {

        $patient = Patient::find($id);
        if (is_null($patient)) {
            return [
                'message' => 'Patient not found',
                "status" => 404
            ];
        }
        $patient->update([
            'first_name' => $request->first_name ?? $patient->first_name,
            'last_name' => $request->last_name ?? $patient->last_name,
            'medical_history' => $request->medical_history ?? $patient->medical_history,
            'image' => $request->image ?? $patient->image,
            'date_of_birth' => $request->date_of_birth  ?? $patient->date_of_birth,
            'state' => $request->state ?? $patient->state,
            'city' => $request->city ?? $patient->city,
            'street' => $request->street ?? $patient->street,
            'phone_number' => $request->phone_number ?? $patient->phone_number,
            'gender' => $request->gender ?? $patient->gender,
        ]);

        return [
            'message' => 'patient updated successfully',
            'patient' => $patient,
            "status" => 200
        ];
    }
}
