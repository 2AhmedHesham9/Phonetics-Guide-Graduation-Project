<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Specialist\AuthSpecialistService;
use App\Http\Controllers\PatientController;
use App\Interfaces\AuthenticationInterface;
use App\Services\Patient\AuthPatientService;
use App\Http\Controllers\SpecialistController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(PatientController::class)
                ->needs(AuthenticationInterface::class)
                ->give(AuthPatientService::class);

        $this->app->when(SpecialistController::class)
                    ->needs(AuthenticationInterface::class)
                    ->give(AuthSpecialistService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
