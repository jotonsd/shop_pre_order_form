<?php

namespace Joton\PreOrder\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Joton\PreOrder\Traits\LoggerTrait;

abstract class Controller extends BaseController
{
    use LoggerTrait;

    public function logRequest(Request $request, $id = null)
    {
        $this->storeLogRequest($request, $id);
    }

    public function logResponse(JsonResponse $response)
    {
        $this->storeLogResponse($response);
    }
}
