<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::prefix('patient')->controller(PatientController::class)->group(function () {
    route::Post('register', 'register');
    route::Post('login', 'login');

    Route::middleware('auth:patient', 'patientmiddleware')->group(function () {
        route::get('get', function () {
            return response()->json(Auth::user());
        });
        Route::Post('logout','logout');
    });
});
