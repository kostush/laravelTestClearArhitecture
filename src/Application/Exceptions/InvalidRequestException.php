<?php
namespace  Src\Application\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException ;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class InvalidRequestException extends ValidationException
{
    public function __construct(Validator $validator, $response = null, $errorBag = 'default')
    {
        $response = new JsonResponse($validator->errors(), Response::HTTP_BAD_REQUEST);
        parent::__construct($validator, $response, $errorBag);
    }
}