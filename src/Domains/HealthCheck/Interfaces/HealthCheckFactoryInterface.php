<?php

namespace Src\Domains\HealthCheck\Interfaces;


interface HealthCheckFactoryInterface
{
    public function create (array $attributes = []): HealthCheckEntityInterface;
}