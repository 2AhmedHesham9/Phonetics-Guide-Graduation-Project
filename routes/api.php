<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SpecialistController;

Route::prefix('patient')->controller(PatientController::class)->group(function () {
    route::Post('register', 'register');
    route::Post('login', 'login');

    Route::middleware(['auth:patient', 'patientmiddleware'])->group(function () {
        route::get('get', function () {
            return response()->json(Auth::user());
        });
        Route::put('/{id}/update', 'update');
        Route::Post('logout', 'logout');
        Route::GET('/my-specialist', 'getMySpecialist');
    });
});


Route::prefix('specialist')->controller(SpecialistController::class)->group(function () {

    Route::Post('register', 'register');
    Route::Post('login', 'login');

    Route::middleware(['auth:specialist', 'specialistMiddleware'])->group(function () {
        route::get('get', function () {
            return response()->json(Auth::user());
        });
        Route::put('/{id}/update', 'update');
        Route::Post('logout', 'logout');
        Route::Post('add/patient', 'addpatient')->middleware('active.patient.with.specialist');
        Route::GET('get/patients', 'getPatientsForSpecialist');
    });
});
