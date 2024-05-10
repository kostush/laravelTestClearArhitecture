<?php
namespace Src\UI\Http\Responses;

use Illuminate\Http\JsonResponse;
use Src\Domains\HealthCheck\Interfaces\HealthCheckResponseInterface;

class HealthCheckFailedResponse extends JsonResponse implements  HealthCheckResponseInterface
{
  public function __construct($data = null, $status = 200, $headers = [], $options = 0, $json = false)
  {
      parent::__construct($data, $status, $headers, $options, $json);
  }
}
