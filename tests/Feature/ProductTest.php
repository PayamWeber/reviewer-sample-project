<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;
use Mockery\MockInterface;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_product_service_getAllActiveProducts_works_fine(): void
    {
        $this->mock(ProductRepositoryInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('getAllActiveProducts')->withAnyArgs()->andReturn(
                Collection::make([
                    new Product()
                ])
            );
        });

        /** @var ProductService $productService */
        $productService = app(ProductService::class);

        $this->assertEquals(Collection::make([
            new Product()
        ]), $productService->getAllActiveProducts());
    }
}
