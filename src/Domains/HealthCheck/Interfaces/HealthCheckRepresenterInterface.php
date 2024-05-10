<?php

namespace Src\Domains\HealthCheck\Interfaces;


interface HealthCheckRepresenterInterface
{
    public function confirmed(HealthCheckEntityInterface $healthCheckEntity): HealthCheckResponseInterface;
    public function failed(HealthCheckEntityInterface $healthCheckEntity): HealthCheckResponseInterface;

}