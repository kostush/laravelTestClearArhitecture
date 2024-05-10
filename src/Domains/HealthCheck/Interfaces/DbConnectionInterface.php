<?php

namespace Src\Domains\HealthCheck\Interfaces;

interface DbConnectionInterface
{
    public function checkConnection(): bool;
}