<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(\App\Repositories\Contracts\UserRepository::class, \App\Repositories\Eloquent\EloquentUserRepository::class);
        $this->app->scoped(\App\Services\Contracts\AuthService::class, \App\Services\AuthService::class);
        $this->app->scoped(\App\Services\Contracts\UserManagementService::class, \App\Services\UserManagementService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
