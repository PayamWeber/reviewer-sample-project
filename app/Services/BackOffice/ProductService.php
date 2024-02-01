<?php

namespace App\Services\BackOffice;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\DTO\ProductCreateDTO;

class ProductService
{
    public function create(ProductCreateDTO $data)
    {
        $productRepo = app(ProductRepositoryInterface::class);

        return $productRepo->create($data);
    }
}