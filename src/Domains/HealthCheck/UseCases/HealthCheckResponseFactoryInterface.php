<?php

namespace Src\Domains\HealthCheck\UseCases;


use Src\Domains\HealthCheck\Interfaces\HealthCheckEntityInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckResponseInterface;

interface HealthCheckResponseFactoryInterface
{
    public function healthCheckFailed(HealthCheckEntityInterface $healthCheckEntity): HealthCheckResponseInterface;
    public function healthCheckConfirmed(HealthCheckEntityInterface $healthCheckEntity): HealthCheckResponseInterface;
}