<?php

namespace Src\Application\Adapters\Presenters;

use Src\Domains\HealthCheck\Interfaces\HealthCheckEntityInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckRepresenterInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckResponseInterface;
use Src\UI\Http\Responses\HealthCheckConfirmedResponse;
use Src\UI\Http\Responses\HealthCheckFailedResponse;

class HealthCheckJsonPresenter implements HealthCheckRepresenterInterface
{
    private $failedStatus = 500;
    private $confirmedStatus = 200;

    public function failed(HealthCheckEntityInterface $healthCheckEntity): HealthCheckResponseInterface
    {
        return new HealthCheckFailedResponse(
            $this->getData($healthCheckEntity),
            $this->failedStatus
        );
    }

    public function confirmed(HealthCheckEntityInterface $healthCheckEntity): HealthCheckResponseInterface
    {
       return new HealthCheckConfirmedResponse(
           $this->getData($healthCheckEntity),
           $this->confirmedStatus
       );
    }

    private function getData($healthCheckEntity):array
    {
        return  [
            'db'=> $healthCheckEntity->getDb(),
            'cache' => $healthCheckEntity->getCache()
        ];
    }
}