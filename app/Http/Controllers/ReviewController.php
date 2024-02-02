<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductReviewableOnlyByBuyersException;
use App\Http\Requests\ReviewSubmitRequest;
use App\Models\Product;
use App\Services\DTO\ReviewCreateDTO;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;
use Throwable;

class ReviewController extends Controller
{
    public function submit(ReviewSubmitRequest $request, ReviewService $reviewService): JsonResponse
    {
        /** @var Product $product This variable always has value because we checked it in validation */
        $product = Product::query()->find($request->get('product_id'));

        $dto = (new ReviewCreateDTO())
            ->setProduct($product)
            ->setUser($request->user())
            ->setVote($request->get('vote'))
            ->setDescription($request->get('description'));

        try {
            $reviewService->submit($dto);

            return $this->successResponse();
        } catch (ProductReviewableOnlyByBuyersException $e) {
            return $this->failResponse($e->getMessage());
        } catch (Throwable $e) {
            logger()->error($e->getMessage(), [
                'product_id' => $dto->getProduct()->id
            ]);
            return $this->failResponse("server error");
        }
    }
}