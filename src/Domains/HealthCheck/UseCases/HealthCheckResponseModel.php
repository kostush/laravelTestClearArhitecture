<?php

namespace Src\Domains\HealthCheck\UseCases;

use Src\Domains\HealthCheck\Interfaces\HealthCheckEntityInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckResponseInterface;

class HealthCheckResponseModel implements HealthCheckResponseInterface
{
    public function __construct(
        private HealthCheckEntityInterface $healthCheck
    ) {}

    public function getHealthCheck(): HealthCheckEntityInterface
    {
        return $this->healthCheck;
    }
}