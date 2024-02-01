<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService
{
    public function getAllActiveProducts()
    {
        $productRepo = app(ProductRepositoryInterface::class);

        return $productRepo->getAllActiveProducts();
    }
}