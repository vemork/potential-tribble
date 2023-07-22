<?php

namespace App\Application;

use App\Infrastructure\ProductRepositoryInMemory;

class GetProductsUseCase
{
    private $productRepository;

    public function __construct(ProductRepositoryInMemory $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute()
    {
        return $this->productRepository->getAll();
    }
}
