<?php

namespace Src\UI\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Src\Domains\HealthCheck\UseCases\HealthCheckRequestModel;
use Src\Domains\HealthCheck\UseCases\HealthCheckUseCaseInterface;
use Src\UI\Http\Requests\HealthCheckRequest;


class HealthCheckController extends Controller
{
    public function __construct( private  HealthCheckUseCaseInterface $healthCheckUseCase){}

    public function check(HealthCheckRequest $request)
    {
        try{

            return  $this->healthCheckUseCase->check(
                    new HealthCheckRequestModel(
                        $request->xOwner()
                    )
            );
        }catch(\Exception $e){
            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}