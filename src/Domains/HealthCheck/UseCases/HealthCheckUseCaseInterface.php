<?php

namespace Src\Domains\HealthCheck\UseCases;


use Illuminate\Http\Request;
use Src\Domains\HealthCheck\Interfaces\HealthCheckResponseInterface;

interface HealthCheckUseCaseInterface
{
    public function check(HealthCheckRequestModel $healthCheckRequestModel): HealthCheckResponseInterface;
}