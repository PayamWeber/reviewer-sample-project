<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getAllActiveProducts(): Collection;
}