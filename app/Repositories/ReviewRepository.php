<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Review;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Services\DTO\ReviewCreateDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ReviewRepository implements ReviewRepositoryInterface
{
    /**
     * @param ReviewCreateDTO $data
     * @return Builder|Model|Review
     */
    public function create(ReviewCreateDTO $data): Builder|Model|Review
    {
        return Review::query()->create([
            'user_id' => $data->getUser()->id,
            'product_id' => $data->getProduct()->id,
            'vote' => $data->getVote(),
            'description' => $data->getDescription(),
        ]);
    }

    /**
     * @param Product $product
     * @return int
     */
    public function getAverageVotesForProduct(Product $product): int
    {
        return Review::query()->where('product_id', $product->id)
            ->avg('vote') ?: 0;
    }
}