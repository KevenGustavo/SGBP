<?php

namespace App\Providers;

use App\Models\Bem;
use App\Observers\BemObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Bem::observe(BemObserver::class);
    }
}
