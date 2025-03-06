<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginPatientRequest;
use App\Models\Patient;
use App\Traits\ApiResponses;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Services\Patient\AuthPatientService;

class PatientController extends Controller
{
    use ApiResponses;
    protected $patientService;
    public function __construct(AuthPatientService $patientService)
    {
        $this->patientService = $patientService;
        // $this->middleware('auth:api', ['except' => ['login']]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function register(StorePatientRequest $request)
    {
        $patient = $this->patientService->register($request);
        // return Response()->json($patient,200);
        return  $this->ok($patient);
    }


    public function login(LoginPatientRequest $request)
    {
        $patient = $this->patientService->login($request);
        return Response()->json($patient, 200);
    }


    public function logout()
    {
        $response = $this->patientService->logout();
        return Response()->json($response['message'], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
