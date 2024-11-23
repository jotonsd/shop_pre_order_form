<?php

namespace Joton\PreOrder\Exceptions;

use Exception;
use Throwable;
use Joton\PreOrder\Traits\LoggerTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class CustomExceptionHandler extends ExceptionHandler
{
    use LoggerTrait;
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        return response()->json([
            'success' => false,
            'message' => $exception->getMessage(),
        ], 400);
    }
}
