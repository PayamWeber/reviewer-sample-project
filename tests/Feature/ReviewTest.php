<?php

namespace Tests\Feature;

use App\Models\Enums\ProductReviewableType;
use App\Models\Product;
use App\Models\Review;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Services\DTO\ReviewCreateDTO;
use App\Services\ReviewService;
use Illuminate\Database\Eloquent\Collection;
use Mockery\MockInterface;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    public function test_the_review_submit_works(): void
    {
        $this->mock(ProductRepositoryInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('getAllActiveProducts')->withAnyArgs()->andReturn(
                Collection::make([
                    new Product()
                ])
            );
            $mock->shouldReceive('updateVotes')->withAnyArgs()->andReturnTrue();
        });
        $this->mock(ReviewRepositoryInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('create')->withAnyArgs()->andReturn(new Review());
            $mock->shouldReceive('getAverageVotesForProduct')->withAnyArgs()->andReturn(10);
        });

        /** @var ReviewService $productService */
        $productService = app(ReviewService::class);
        $product = new Product();
        $dto = (new ReviewCreateDTO())
            ->setVote(10)
            ->setProduct($product)
            ->setDescription("");

        $this->assertEquals((new Review()), $productService->submit($dto));
    }

    public function test_the_review_submit_errors_while_product_is_buyers_only(): void
    {
        $this->mock(ProductRepositoryInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('getAllActiveProducts')->withAnyArgs()->andReturn(
                Collection::make([
                    new Product()
                ])
            );
            $mock->shouldReceive('updateVotes')->withAnyArgs()->andReturnTrue();
        });
        $this->mock(ReviewRepositoryInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('create')->withAnyArgs()->andReturn(new Review());
            $mock->shouldReceive('getAverageVotesForProduct')->withAnyArgs()->andReturn(10);
        });

        /** @var ReviewService $productService */
        $productService = app(ReviewService::class);
        $product = new Product();
        $product->reviewable_type = ProductReviewableType::REVIEWABLE_TO_BUYER_ONLY;
        $dto = (new ReviewCreateDTO())
            ->setVote(10)
            ->setProduct($product)
            ->setDescription("");

        try {
            $productService->submit($dto);
        } catch (\Exception $e) {
            $this->assertEquals("This product is reviewable only by buyers", $e->getMessage());
        }
    }
}
