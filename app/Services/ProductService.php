<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\DTO\ProductCreateDTO;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    private ProductRepositoryInterface $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return Product[]|Collection
     */
    public function getAllActiveProducts(): array|Collection
    {
        return $this->productRepository->getAllActiveProducts();
    }

    /**
     * @param ProductCreateDTO $data
     * @return Product
     */
    public function create(ProductCreateDTO $data): Product
    {
        return $this->productRepository->create($data);
    }
}