<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\DTO\ProductCreateDTO;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    /**
     * @return Product[]|Collection
     */
    public function getAllActiveProducts(): array|Collection
    {
        /** @var ProductRepositoryInterface $productRepo */
        $productRepo = app(ProductRepositoryInterface::class);

        return $productRepo->getAllActiveProducts();
    }

    /**
     * @param ProductCreateDTO $data
     * @return Product
     */
    public function create(ProductCreateDTO $data): Product
    {
        /** @var ProductRepositoryInterface $productRepo */
        $productRepo = app(ProductRepositoryInterface::class);

        return $productRepo->create($data);
    }
}