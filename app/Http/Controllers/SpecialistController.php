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
use App\Http\Requests\PatientSpecialist\SpecialistUpdatePatientRequest;


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

        public function getSpecialistes(){
        $response = $this->specialistService->getSpecialistes();
        return response()->json($response,200);
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




    public function update(UpdatespecialistRequest $request,  $id) {

            $response = $this->specialistService->updateProfile($request, $id);
            return response()->json($response, $response['status']);


    }
    public function addPatient(SpecialistAddPatientRequest $specialistAddPatientRequest){
        $response=$this->patientSpecialistService->addPatient($specialistAddPatientRequest);
        return response()->json($response);

    }

    public function deletePatient($patient_id) {
        $response = $this->patientSpecialistService->specilaistDeletePatient($patient_id);
        return response()->json($response);
    }
    public function getPatientsForSpecialist(){

        $response=$this->patientSpecialistService->getPatientsForSpecialist();
        return response()->json($response);
    }
    public function specialsitUpdatePatient(SpecialistUpdatePatientRequest $request, $patient_id){

        $response = $this->patientSpecialistService->specilaistupdatePatient ($request,$patient_id);
        return response()->json($response);
    }
}
