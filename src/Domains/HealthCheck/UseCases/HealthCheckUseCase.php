<?php

namespace Src\Domains\HealthCheck\UseCases;

use Illuminate\Http\Request;
use Src\Domains\HealthCheck\Interfaces\DbConnectionInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckFactoryInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckRepositoryInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckRepresenterInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckResponseInterface;
use Src\Domains\HealthCheck\Interfaces\RedisConnectionInterface;
use Src\UI\Http\Requests\HealthCheckRequest;

class HealthCheckUseCase implements HealthCheckUseCaseInterface
{
    public function __construct(
        private HealthCheckRepresenterInterface $healthCheckRepresenter,
        private HealthCheckFactoryInterface $healthCheckFactory,
        private HealthCheckRepositoryInterface $healthCheckRepository,
        private DbConnectionInterface $dbConnection,
        private RedisConnectionInterface $redisConnection
    ){}

    public function check(HealthCheckRequestModel $healthCheckRequestModel): HealthCheckResponseInterface
    {
        $cacheCheck = $this->redisConnection->checkConnection();
        $dbCheck = $this->dbConnection->checkConnection();

        $healthCheck = $this->healthCheckFactory->create(
            [
                'owner'=> $healthCheckRequestModel->getXOwner(),
                'db' => $dbCheck,
                'cache' => $cacheCheck
            ]
        );

        if ($dbCheck){
            $this->healthCheckRepository->save($healthCheck);
        }

        if ($dbCheck && $cacheCheck){
            return $this->healthCheckRepresenter->confirmed($healthCheck);
        }
        return $this->healthCheckRepresenter->failed($healthCheck);
    }
}