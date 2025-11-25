<?php

namespace App\Providers;

use App\Models\Training;
use App\Models\TrainingSchedule;
use App\Observers\ScheduleObserver;
use App\Observers\TrainingObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // User Management
        $this->app->scoped(\App\Repositories\Contracts\UserRepository::class, \App\Repositories\Eloquent\EloquentUserRepository::class);
        $this->app->scoped(\App\Services\Contracts\AuthService::class, \App\Services\AuthService::class);
        $this->app->scoped(\App\Services\Contracts\UserManagementService::class, \App\Services\UserManagementService::class);

        // Training Management
        $this->app->scoped(\App\Repositories\Contracts\TrainingRepositoryInterface::class, \App\Repositories\Eloquent\TrainingRepository::class);
        $this->app->scoped(\App\Services\Contracts\TrainingServiceInterface::class, \App\Services\TrainingService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Training::observe(TrainingObserver::class);
        TrainingSchedule::observe(ScheduleObserver::class);
    }
}
