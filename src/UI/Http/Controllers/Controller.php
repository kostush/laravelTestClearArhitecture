<?php
namespace Src\UI\Http\Controllers;

use Illuminate\Http\JsonResponse ;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Controller extends BaseController
{
    /**
     * @param Throwable $error
     * @return JsonResponse
     */
    protected function badRequest(\Throwable $error): JsonResponse
    {
        return response()->json(
            $this->buildResponse($error),
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * @param Throwable $error
     * @return JsonResponse
     */
    protected function error(\Throwable $error, $httpResponse = Response::HTTP_BAD_REQUEST): JsonResponse
    {

        return response()->json(
            $this->buildResponse($error),
            $httpResponse
        );
    }

    /**
     * @param Throwable $error
     * @return array
     */
    protected function buildResponse( Throwable $error): array
    {
        $response = [
            'error'=> $error->getMessage(),
            'code' => $error->getCode()
        ];

        return $response;
    }
}