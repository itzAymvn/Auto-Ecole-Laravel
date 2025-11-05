<?php

namespace App\Providers;

use App\Repositories\Contracts\ExamRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\SessionRepositoryInterface;
use App\Repositories\Contracts\SpendingRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use App\Repositories\Eloquent\ExamRepository;
use App\Repositories\Eloquent\PaymentRepository;
use App\Repositories\Eloquent\SessionRepository;
use App\Repositories\Eloquent\SpendingRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\VehicleRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Repository Service Provider
 *
 * Binds repository interfaces to their concrete implementations.
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ExamRepositoryInterface::class, ExamRepository::class);
        $this->app->bind(SessionRepositoryInterface::class, SessionRepository::class);
        $this->app->bind(VehicleRepositoryInterface::class, VehicleRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(SpendingRepositoryInterface::class, SpendingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
