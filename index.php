<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-Type: application/json');


require 'src/Application/GetProductsUseCase.php';
require 'src/Infrastructure/ProductRepositoryInMemory.php';
require 'src/Presentation/ProductController.php';

use App\Application\GetProductsUseCase;
use App\Infrastructure\ProductRepositoryInMemory;
use App\Presentation\ProductController;

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestPath = $_SERVER['REQUEST_URI'];

// Dependencias de la infraestructura
$productRepository = new ProductRepositoryInMemory();

// Dependencias de la aplicación
$getProductsUseCase = new GetProductsUseCase($productRepository);

// Controlador para listar productos
$productController = new ProductController($getProductsUseCase);

// Endpoint para listar productos
if ($requestMethod === 'GET' && $requestPath === '/productos') {
    $response = $productController->getProducts();
    echo json_encode($response);
}