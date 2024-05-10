<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class Owner
{
    public function handle(Request $request, Closure $next)
    {
        $owner = $request->header('x-owner');
        if (empty($owner) || !Uuid::isValid($owner)){
            return new JsonResponse([
                'Bad request'=>'Missed or invalid Owner key'
            ], Response::HTTP_BAD_REQUEST);
        }
        return $next($request);
    }
}
