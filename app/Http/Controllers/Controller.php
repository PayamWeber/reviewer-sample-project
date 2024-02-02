<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param mixed $data
     * @return JsonResponse
     */
    protected function successResponse(mixed $data = []): JsonResponse
    {
        return new JsonResponse([
            'status' => true,
            'data' => $data
        ]);
    }

    /**
     * @param mixed $data
     * @return JsonResponse
     */
    protected function failResponse(mixed $data = []): JsonResponse
    {
        return new JsonResponse([
            'status' => false,
            'data' => $data
        ], Response::HTTP_BAD_REQUEST);
    }
}
