<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\MaintenanceMode;
use Illuminate\Foundation\MaintenanceModeManager;
use Illuminate\Support\Facades\View;
use App\View\Composers\CartComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
            $this->app->singleton(MaintenanceMode::class, MaintenanceModeManager::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enregistrer le View Composer pour la navbar
        View::composer('partials.nav', CartComposer::class);
    }
}
