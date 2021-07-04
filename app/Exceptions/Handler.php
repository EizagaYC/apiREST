<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function invalidJson($request, ValidationException $exception)
    {  
        return response()->json([
            'msg' =>  "Los datos proporcionados no son validos.",
            'error' =>  $exception->errors(),
        ], $exception->status);

        return parent::render($request, $exception);
    }

    public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json([
                'res' => false,
                'error' => "Error objeto no encontrado"
            ], 400);
        }

        return parent::render($request, $exception);
    }


}
