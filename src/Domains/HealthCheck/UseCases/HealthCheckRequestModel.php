<?php

namespace Src\Domains\HealthCheck\UseCases;

class HealthCheckRequestModel
{
    public function __construct(public string $xOwner){}

    public function getXOwner(): string
    {
        return $this->xOwner;
    }
}