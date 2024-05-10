<?php

namespace Src\Domains\HealthCheck\Interfaces;

interface HealthCheckEntityInterface
{
    public function getDb();
    public function getCache();
    public function getOwner();
}