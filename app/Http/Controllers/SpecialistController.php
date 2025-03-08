<?php

namespace App\Http\Controllers;

use App\Models\specialist;
use  App\Services\Specialist\AuthSpecialistService;
use App\Http\Requests\StorespecialistRequest;
use App\Http\Requests\UpdatespecialistRequest;
use App\Http\Requests\Specialist\LoginSpecialistRequest;

class SpecialistController extends Controller
{
    protected $authSpecialistService;
    public function  __construct(AuthSpecialistService $authSpecialistService)
    {
        $this->authSpecialistService = $authSpecialistService;
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
    public function update(UpdatespecialistRequest $request, specialist $specialist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(specialist $specialist)
    {
        //
    }
}
