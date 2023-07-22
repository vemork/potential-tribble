<?php

namespace App\Infrastructure;

class ProductRepositoryInMemory
{
    private $products;

    public function __construct()
    {
        // Simulación de una base de datos
        $this->products = [
            [
                'id' => 1,
                'nombre' => 'Producto 1',
                'referencia' => 'REF001',
                'precio' => 100.50,
                'peso' => 0.5,
                'categoria' => 'Electrónica',
                'stock' => 10,
                'fecha_creacion' => '2023-07-19'
            ],
            // Agrega más productos aquí...
        ];
    }

    public function getAll()
    {
        return $this->products;
    }
}
