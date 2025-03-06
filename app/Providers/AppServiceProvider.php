<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\PatientController;
use App\Interfaces\AuthenticationInterface;
use App\Services\Patient\AuthPatientService;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
