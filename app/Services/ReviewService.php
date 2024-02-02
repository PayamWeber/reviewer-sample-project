<?php

namespace App\Services;

use App\Models\Enums\ProductReviewableType;
use App\Models\Product;
use App\Models\Review;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Services\DTO\ReviewCreateDTO;
use Exception;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Cache;

class ReviewService
{
    private ReviewRepositoryInterface $reviewRepository;
    private ProductRepositoryInterface $productRepository;

    /**
     * @param ReviewRepositoryInterface $reviewRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ReviewRepositoryInterface $reviewRepository, ProductRepositoryInterface $productRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param ReviewCreateDTO $data
     * @return Review|false
     * @throws Exception
     */
    public function submit(ReviewCreateDTO $data): Review|false
    {
        if ($data->getProduct()->reviewable_type == ProductReviewableType::REVIEWABLE_TO_BUYER_ONLY) {
            throw new Exception("This product is reviewable only by buyers");
        }

        if ($review = $this->reviewRepository->create($data)){
            $this->updateVotesForProduct($data);

            return $review;
        }

        return false;
    }

    /**
     * @param ReviewCreateDTO $data
     * @return void
     */
    public function updateVotesForProduct(ReviewCreateDTO $data): void
    {
        Cache::lock('voting_product_' . $data->getProduct()->id, 2)
            ->get(function () use ($data) {
                $avg = $this->reviewRepository->getAverageVotesForProduct($data->getProduct());
                $this->productRepository->updateVotes($data->getProduct(), $avg);
            });
    }
}