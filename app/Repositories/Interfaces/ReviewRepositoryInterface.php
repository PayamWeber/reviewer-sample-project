<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;
use App\Models\Review;
use App\Services\DTO\ReviewCreateDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface ReviewRepositoryInterface
{
    public function create(ReviewCreateDTO $data): Builder|Model|Review;
    public function getAverageVotesForProduct(Product $product): int;
}