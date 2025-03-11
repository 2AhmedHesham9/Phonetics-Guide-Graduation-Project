<?php

namespace App\Http\Controllers;

use App\Models\specialist;
use App\Services\Specialist\SpecialistService;
use  App\Services\Specialist\AuthSpecialistService;
use App\Http\Requests\Specialist\LoginSpecialistRequest;
use App\Http\Requests\specialist\StorespecialistRequest;

use App\Http\Requests\specialist\UpdatespecialistRequest;
use App\Services\Patient_Specialist\PatientSpecialistService;
use App\Http\Requests\PatientSpecialist\SpecialistAddPatientRequest;

class SpecialistController extends Controller
{
    protected $authSpecialistService;
    protected $specialistService;
    protected $patientSpecialistService;
    public function  __construct(AuthSpecialistService $authSpecialistService,SpecialistService $specialistService, PatientSpecialistService $PatientSpecialistService)
    {
        $this->authSpecialistService = $authSpecialistService;
        $this->specialistService = $specialistService;
        $this->patientSpecialistService=$PatientSpecialistService;
    }
    public function register(StorespecialistRequest $request)
    {
        $specialist = $this->authSpecialistService->register($request);
        return Response()->json($specialist, 200);
        // return  $this->ok($patient);
    }


    public function login(LoginSpecialistRequest $request)
    {
        $specialist = $this->authSpecialistService->login($request);
        return Response()->json($specialist, 200);
    }
    public function logout()
    {
        $response = $this->authSpecialistService->logout();
        return Response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorespecialistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(specialist $specialist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(specialist $specialist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatespecialistRequest $request,  $id) {

            $response = $this->specialistService->updateProfile($request, $id);
            return response()->json($response, $response['status']);


    }

    public function destroy(specialist $specialist)
    {
        //
    }

    public function addPatient(SpecialistAddPatientRequest $specialistAddPatientRequest){
        $response=$this->patientSpecialistService->addPatient($specialistAddPatientRequest);
        return response()->json($response);

    }
    public function getPatientsForSpecialist(){

        $response=$this->patientSpecialistService->getPatientsForSpecialist();
        return response()->json($response);
    }
}
