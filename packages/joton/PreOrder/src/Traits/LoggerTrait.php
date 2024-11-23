<?php

namespace Joton\PreOrder\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait LoggerTrait
{
    /**
     * Log the incoming request.
     *
     * @param Request $request
     * @return void
     */
    public function storeLogRequest(Request $request, $id = null)
    {
        $logData = [
            'request' => [
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'headers' => $request->headers->all(),
                'input' => $request->all(),
                'params' => $id
            ],
        ];

        Log::channel('daily')->info('Request', $logData);
    }

    /**
     * Log the response.
     *
     * @param JsonResponse $response
     * @return void
     */
    public function storeLogResponse(JsonResponse $response)
    {
        $logData = [
            'response' => [
                'status' => $response->getStatusCode(),
                'headers' => $response->headers->all(),
                'content' => $response->getContent(),
            ],
        ];

        Log::channel('daily')->info('Response', $logData);
    }
}
