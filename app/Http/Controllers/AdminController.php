<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Services\Admin\AuthAdminService;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;

class AdminController extends Controller
{
    protected $authAdminService;
    public function  __construct(AuthAdminService $authAdminService)
    {
        $this->authAdminService = $authAdminService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(StoreAdminRequest $request)
    {
        $response =   $this->authAdminService->register($request);
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginRequest $request)
    {
        $response =   $this->authAdminService->login($request);
        return response()->json($response, 200);
    }
    public function logout()
    {
        $response =   $this->authAdminService->logout();

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
