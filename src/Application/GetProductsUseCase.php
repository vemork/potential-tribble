<?php

namespace App\Application;

require 'validaciones.php';

use App\Infrastructure\ProductRepositoryInMemory;

class GetProductsUseCase
{
    private $productRepository;

    public function __construct(ProductRepositoryInMemory $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllUseCase()
    {
        return $this->productRepository->getAll();
    }
    public function setNewProductUseCase($data)
    {
        [$msg, $err] = integridad($data);

        // Validar los datos recibidos (puedes agregar más validaciones según tus requerimientos)
        if ($err) {
            return (array(
                'message' => 'Error: invalid json payload.' . $msg,
                'err' => true,
                'code' => 400
            ));
        }

        return $this->productRepository->setNewProduct($data);
    }
}
