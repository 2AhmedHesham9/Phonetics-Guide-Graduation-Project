<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponses;

use App\Services\Patient\PatientService;
use App\Http\Requests\LoginPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Services\Patient\AuthPatientService;
use App\Services\Patient_Specialist\PatientSpecialistService;

class PatientController extends Controller
{
    use ApiResponses;
    protected $authPatientService;
    protected $patientService;
    protected $patientSpecialistService;
    public function __construct(AuthPatientService $authPatientService, PatientService $patientService, PatientSpecialistService $patientSpecialistService)
    {
        $this->authPatientService = $authPatientService;
        $this->patientService = $patientService;
        $this->patientSpecialistService = $patientSpecialistService;
        // $this->middleware('auth:api', ['except' => ['login']]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function register(StorePatientRequest $request)
    {
        $patient = $this->authPatientService->register($request);
        return Response()->json($patient, 200);
        // return  $this->ok($patient);
    }


    public function login(LoginPatientRequest $request)
    {
        $patient = $this->authPatientService->login($request);
        return Response()->json($patient, 200);
        return Response()->json("hi", 200);
    }


    public function logout()
    {
        $response = $this->authPatientService->logout();
        return Response()->json($response, 200);
    }
    public function update(UpdatePatientRequest $request,  $id)
    {
        $response = $this->patientService->updateProfile($request, $id);
        return response()->json($response, $response['status']);
    }
    public function getMySpecialist()
    {
        $response = $this->patientSpecialistService->getSpecialistForPatient();
        return response()->json($response);
    }
}
