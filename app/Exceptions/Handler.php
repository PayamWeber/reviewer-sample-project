<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (ValidationException $e, Request $request) {
            return response()->json([
                'status' => false,
                'data' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        });

        if (! app()->hasDebugModeEnabled()) {
            $this->renderable(function (Throwable $e, Request $request) {
                return response()->json([
                    'status' => false,
                    'data' => "internal server error"
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            });
        }
    }
}
