<?php

namespace Src\Domains\HealthCheck\Interfaces;
interface HealthCheckRepositoryInterface
{
    public function save(HealthCheckEntityInterface $healhtCheckEntity): HealthCheckEntityInterface;
}