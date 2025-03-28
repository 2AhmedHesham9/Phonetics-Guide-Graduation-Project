<?php

use App\Models\Patient;

use App\Models\specialist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SpecialistController;




Route::prefix('public')->controller(SpecialistController::class)->group(function () {
    Route::GET('/specialist', 'getSpecialistes');
});


Route::prefix('admin')->controller(AdminController::class)->group(function () {
    route::Post('register', 'register');
    route::Post('login', 'login')->middleware('custom.throttle:5,1');

    Route::middleware(['auth:admin','admin.middleware'])->group(function () {
        Route::Post('logout', 'logout');
    });
});

//^ Patient Apis

Route::prefix('patient')->controller(PatientController::class)->group(function () {
    route::Post('register', 'register');
    route::Post('login', 'login')->middleware('custom.throttle:5,1');

    Route::middleware(['auth:patient', 'patientmiddleware'])->group(function () {
        route::get('get', function () {
            return response()->json(Auth::user());
        });
        Route::put('/{id}/update', 'update');
        Route::Post('logout', 'logout');
        Route::GET('/my-specialist', 'getMySpecialist');
        Route::Get('delete/my-specialist', 'deleteMySpecialist');
    });
});

// ^Specialist APIs
Route::prefix('specialist')->controller(SpecialistController::class)->group(function () {

    Route::Post('register', 'register');
    Route::Post('login', 'login')->middleware('custom.throttle:5,1');

    Route::middleware(['auth:specialist', 'specialistMiddleware'])->group(function () {

        Route::put('/{id}/update', 'update');
        Route::Post('logout', 'logout');
        Route::Post('add/patient', 'addpatient')->middleware('active.patient.with.specialist');
        Route::GET('get/patients', 'getPatientsForSpecialist');
        Route::GET('/patient/{patient_id}/update', 'specialsitUpdatePatient')->middleware('specialist.has.this.patient');
        Route::Delete('{patient_id}/delete', 'deletePatient')->middleware('specialist.has.this.patient');
    });
});


Route::get('/target', function () {

    return response()->json(["target" => "سلام"], 200);
});

Route::get('/search', function () {

    $data = specialist::Search('esham')->get();
    return response()->json($data, 200);
});
