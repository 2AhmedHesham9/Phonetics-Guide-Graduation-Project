<?php

namespace App\Services\Specialist;


use App\Models\specialist;

use App\Http\Requests\Specialist\UpdateSpecialistRequest;

class SpecialistService
{

    public function __construct()
    {
        //
    }
    public function UpdateProfile(UpdateSpecialistRequest $request,  $id)
    {

        $specialist = Specialist::find($id);
        if (is_null($specialist)) {
            return [
                'message' => 'Specialist not found',
                "status" => 404
            ];
        }
        $specialist->update([
            'first_name' => $request->first_name ?? $specialist->first_name,
            'last_name' => $request->last_name ?? $specialist->last_name,
            'years_of_experince' => $request->years_of_experince ?? $specialist->years_of_experince,
            'image' => $request->image ?? $specialist->image,
            'date_of_birth' => $request->date_of_birth  ?? $specialist->date_of_birth,
            'clinic_state' => $request->clinic_state ?? $specialist->clinic_state,
            'clinic_city' => $request->clinic_city ?? $specialist->clinic_city,
            'clinic_street' => $request->clinic_street ?? $specialist->clinic_street,
            'phone_number' => $request->phone_number ?? $specialist->phone_number,
            'gender' => $request->gender ?? $specialist->gender,
        ]);

        return [
            'message' => 'Specialist updated successfully',
            'specialist' => $specialist,
            "status" => 200
        ];
    }
}
