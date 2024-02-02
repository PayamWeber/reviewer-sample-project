<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewSubmitRequest;
use App\Models\Product;
use App\Services\DTO\ReviewCreateDTO;
use App\Services\ReviewService;
use Exception;

class ReviewController extends Controller
{
    public function submit(ReviewSubmitRequest $request, ReviewService $reviewService)
    {
        /** @var Product $product */
        $product = Product::query()->find($request->get('product_id'));

        $dto = (new ReviewCreateDTO())
            ->setProduct($product)
            ->setVote($request->get('vote'))
            ->setDescription($request->get('description'));

        try {
            $reviewService->submit($dto);

            return $this->successResponse();
        } catch (Exception $e) {
            logger()->error($e->getMessage(), [
                'product_id' => $dto->getProduct()->id
            ]);
            return $this->failResponse($e->getMessage());
        }
    }
}