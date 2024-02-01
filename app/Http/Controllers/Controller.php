<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param mixed $data
     * @return JsonResponse
     */
    protected function successResponse(mixed $data): JsonResponse
    {
        return new JsonResponse([
            'status' => true,
            'data' => $data
        ]);
    }
}
