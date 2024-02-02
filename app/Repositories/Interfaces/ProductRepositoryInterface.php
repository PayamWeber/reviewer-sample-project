<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;
use App\Services\DTO\ProductCreateDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    public function getAllActiveProducts(): Collection;
    public function create(ProductCreateDTO $data): Builder|Model|Product;
    public function updateVotes(Product $product, int $votes): bool;
}