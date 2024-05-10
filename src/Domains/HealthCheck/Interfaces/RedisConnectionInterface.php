<?php

namespace Src\Domains\HealthCheck\Interfaces;

interface RedisConnectionInterface
{
    public function checkConnection(): bool;
}