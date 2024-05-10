<?php

namespace Src\Domains\HealthCheck\UseCases;

class HealthCheckResponseFactory
{
    public function create(bool $dbCheck, bool $cacheCheck): HealthCheckDto
    {
        return new HealthCheckDto($dbCheck, $cacheCheck);
    }
}