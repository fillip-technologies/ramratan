<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }


    public function boot(): void
    {
       Route::middleware(['web', 'admin'])
            ->group(base_path('routes/admin.php'));

      Route::middleware('web')
            ->group(base_path('routes/shipping.php'));

    }
}
