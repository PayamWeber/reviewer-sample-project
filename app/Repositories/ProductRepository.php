<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Provider;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\DTO\ProductCreateDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @return Collection
     */
    public function getAllActiveProducts(): Collection
    {
        return Product::query()
            ->with(['provider', 'reviews' => function($query){
                return $query->latest();
            }])
            ->where('active', true)
            ->latest()
            ->get();
    }

    /**
     * @param ProductCreateDTO $data
     * @return Builder|Model|Product
     */
    public function create(ProductCreateDTO $data): Builder|Model|Product
    {
        return Product::query()->create([
            'title' => $data->getTitle(),
            'price' => $data->getPrice(),
            'creator_id' => $data->getCreator()->id,
            'provider_id' => $data->getProvider()->id,
            'vote' => 0,
            'active' => $data->isActive(),
            'reviewable_type' => $data->getReviewableType()->value,
        ]);
    }

    /**
     * @param Product $product
     * @param int $votes
     * @return bool
     */
    public function updateVotes(Product $product, int $votes): bool
    {
        return $product->update([
            'vote' => $votes
        ]);
    }
}