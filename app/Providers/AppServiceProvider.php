<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Admin\AuthAdminService;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Interfaces\AuthenticationInterface;
use App\Services\Patient\AuthPatientService;
use App\Http\Controllers\SpecialistController;
use App\Services\Specialist\AuthSpecialistService;

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

        $this->app->when(AdminController::class)
            ->needs(AuthenticationInterface::class)
            ->give(AuthAdminService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
