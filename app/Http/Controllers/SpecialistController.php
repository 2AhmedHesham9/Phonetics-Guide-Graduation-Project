<?php

namespace App\Http\Controllers;

use App\Models\specialist;
use App\Services\Specialist\SpecialistService;
use  App\Services\Specialist\AuthSpecialistService;
use App\Http\Requests\Specialist\LoginSpecialistRequest;
use App\Http\Requests\specialist\StorespecialistRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\specialist\UpdatespecialistRequest;

class SpecialistController extends Controller
{
    protected $authSpecialistService;
    protected $specialistService;
    public function  __construct(AuthSpecialistService $authSpecialistService,SpecialistService $specialistService)
    {
        $this->authSpecialistService = $authSpecialistService;
        $this->specialistService = $specialistService;
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(specialist $specialist)
    {
        //
    }
}
