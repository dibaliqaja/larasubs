<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\SubscriptionServiceContract;
use App\Services\SubscriptionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SubscriptionServiceContract::class, SubscriptionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
