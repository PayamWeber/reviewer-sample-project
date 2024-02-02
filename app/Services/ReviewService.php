<?php

namespace App\Services;

use App\Exceptions\ProductReviewableOnlyByBuyersException;
use App\Models\Enums\ProductReviewableType;
use App\Models\Product;
use App\Models\Review;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Services\DTO\ReviewCreateDTO;
use Exception;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Throwable;

class ReviewService
{
    private ReviewRepositoryInterface $reviewRepository;
    private ProductRepositoryInterface $productRepository;

    /**
     * @param ReviewRepositoryInterface $reviewRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param ReviewCreateDTO $data
     * @return Review
     * @throws ProductReviewableOnlyByBuyersException
     * @throws Throwable
     */
    public function submit(ReviewCreateDTO $data): Review
    {
        if ($data->getProduct()->reviewable_type == ProductReviewableType::REVIEWABLE_TO_BUYER_ONLY) {
            throw new ProductReviewableOnlyByBuyersException("This product is reviewable only by buyers");
        }

        DB::beginTransaction();
        try {
            $review = $this->reviewRepository->create($data);
            $voteUpdateResult = $this->updateVotesForProduct($data);

            if (!$voteUpdateResult){
                throw new Exception("vote update failed for product " . $data->getProduct()->id);
            }

            DB::commit();

            return $review;
        } catch (Throwable $throwable) {
            logger()->error($throwable->getMessage(), [
                'trace' => $throwable->getTraceAsString()
            ]);
            DB::rollBack();

            throw $throwable;
        }
    }

    /**
     * @param ReviewCreateDTO $data
     * @return bool
     */
    public function updateVotesForProduct(ReviewCreateDTO $data): bool
    {
        $result = false;
        Cache::lock('voting_product_' . $data->getProduct()->id, 2)
            ->get(function () use ($data, &$result) {
                $avg = $this->reviewRepository->getAverageVotesForProduct($data->getProduct());
                $result = $this->productRepository->updateVotes($data->getProduct(), $avg);
            });

        return $result;
    }
}