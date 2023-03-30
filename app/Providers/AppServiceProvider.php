<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TestServiceInterface;
use App\Services\TestService2;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TestServiceInterface::class, TestService2::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
