<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackOffice\ProductCreateRequest;
use App\Models\Enums\ProductReviewableType;
use App\Models\Provider;
use App\Services\DTO\ProductCreateDTO;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @param ProductCreateRequest $request
     * @return JsonResponse
     */
    public function store(ProductCreateRequest $request, ProductService $productService): JsonResponse
    {
        /** @var Provider $provider Provider always has a value because in validation we checked it */
        $provider = Provider::query()->find($request->get('provider_id'));

        $dto = new ProductCreateDTO();
        $dto->setTitle($request->get('title'))
            ->setReviewableType(ProductReviewableType::from($request->get('reviewable_type')))
            ->setPrice($request->get('price'))
            ->setCreator($request->user())
            ->setProvider($provider)
            ->setActive($request->get('active'));

        if ($productService->create($dto)){
            return $this->successResponse();
        } else {
            return $this->failResponse();
        }
    }
}