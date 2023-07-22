<?php

namespace App\Presentation;

use App\Application\GetProductsUseCase;

class ProductController
{
    private $getProductsUseCase;

    public function __construct(GetProductsUseCase $getProductsUseCase)
    {
        $this->getProductsUseCase = $getProductsUseCase;
    }

    public function getProducts()
    {
        return $this->getProductsUseCase->getAllUseCase();
    }
    public function setProduct($data)
    {
        return $this->getProductsUseCase->setNewProductUseCase($data);
    }
}
