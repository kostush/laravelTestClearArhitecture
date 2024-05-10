<?php
namespace App\Repositories;

use App\Models\HealthCheckModel;
use Src\Domains\HealthCheck\Interfaces\HealthCheckEntityInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckRepositoryInterface;


class HealthCheckRepository implements HealthCheckRepositoryInterface
{

    public function save(HealthCheckEntityInterface $healhtCheckEntity): HealthCheckEntityInterface
    {
        $healthCheck =  new HealthCheckModel([
            'owner'=> $healhtCheckEntity->getOwner(),
            'db' => $healhtCheckEntity->getDb(),
            'cache' => $healhtCheckEntity->getCache()
        ]);
        $healthCheck->save();
        return $healthCheck;
    }
}
