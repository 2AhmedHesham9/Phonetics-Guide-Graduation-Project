<?php

namespace App\Services\Patient_Specialist;

use App\Models\Patient;
use App\Models\specialist;
use App\Models\PatientSpecialist;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PatientSpecialist\SpecialistAddPatientRequest;

class PatientSpecialistService
{
    protected $patientSpecialistService;

    public function __construct() {}
    public function addPatient(SpecialistAddPatientRequest $specialistAddPatientRequest)
    {
        $specialistId = Auth::guard('specialist')->user()->id;
        $patientId = Patient::select('id')->where('specified_id', $specialistAddPatientRequest->specified_id)->first()->id;
        $patientSpecialist = PatientSpecialist::updateOrCreate(
            ['patient_id' => $patientId],
            [
                'specialist_id' => $specialistId,
                'notes' => $specialistAddPatientRequest->notes,
                'start_date' => $specialistAddPatientRequest->start_date,
                'end_date' => $specialistAddPatientRequest->end_date
            ]
        );

        return $patientSpecialist;
    }

    public function getPatientsForSpecialist()
    {
        $specialist = Auth::guard('specialist')->user();
        // $patientsForSpecialist=$specialist->patients()->selectRaw(
        //                                                             'CONCAT(first_name," ",last_name) as Full_Name,
        //                                                             YEAR(CURDATE()) - YEAR(date_of_birth) -
        //                                                             (DATE_FORMAT(CURDATE(), "%m-%d") < DATE_FORMAT(date_of_birth, "%m-%d"))
        //                                                             as age'
        //                                                             )
        //                                                 ->get();
        // $ss=Specialist::with('patients')->get();
        $patientsForSpecialist = $specialist->patients;
        return $patientsForSpecialist;
    }
    public function getSpecialistForPatient()
    {
        $patient = Auth::guard('patient')->user();
        $specialist = $patient->specialist;
        return $specialist;
    }
}
