<?php
namespace App\Factories;

use App\Models\HealthCheckModel;
use Src\Domains\HealthCheck\Interfaces\HealthCheckEntityInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckFactoryInterface;

class HealthCheckFactory implements HealthCheckFactoryInterface
{

    public function create(array $attributes = []): HealthCheckEntityInterface
    {
        return new HealthCheckModel($attributes);
    }
}
