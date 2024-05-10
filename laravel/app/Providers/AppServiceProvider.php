<?php

namespace App\Providers;

use App\Factories\HealthCheckFactory;
use App\Repositories\HealthCheckRepository;
use App\Services\DbConnectionService;
use App\Services\RedisConnectionService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

use Src\Application\Adapters\Presenters\HealthCheckJsonPresenter;
use Src\Domains\HealthCheck\Interfaces\DbConnectionInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckRepositoryInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckRepresenterInterface;
use Src\Domains\HealthCheck\Interfaces\RedisConnectionInterface;
use Src\Domains\HealthCheck\UseCases\HealthCheckUseCase;

use Src\Domains\HealthCheck\UseCases\HealthCheckUseCaseInterface;
use Src\UI\Http\Controllers\HealthCheckController;
use Src\Domains\HealthCheck\Interfaces\HealthCheckFactoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(
            HealthCheckFactoryInterface::class,
            HealthCheckFactory::class,
        );

        $this->app->bind(
            HealthCheckRepresenterInterface::class,
            HealthCheckJsonPresenter::class,
        );

        $this->app->bind(
            HealthCheckRepositoryInterface::class,
            HealthCheckRepository::class,
        );

        $this->app->bind(
            DbConnectionInterface::class,
            DbConnectionService::class,
        );

        $this->app->bind(
            RedisConnectionInterface::class,
            RedisConnectionService::class,
        );


        $this->app
            ->when(HealthCheckController::class)
            ->needs(HealthCheckUseCaseInterface::class)
            ->give(function($app){
                return $app->make(HealthCheckUseCase::class,[
                'output' => $app->make(HealthCheckJsonPresenter::class),
                ]);
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('health-check', function (Request $request) {
            return Limit::perMinute(60)->response(function (Request $request, array $headers) {
                return new JsonResponse(["reason"=>"Too many requests..."], 429, $headers);
            });
        });
        //
    }
}
