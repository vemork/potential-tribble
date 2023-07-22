<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-Type: application/json');

require 'src/Domain/Product.php';
require 'src/Application/GetProductsUseCase.php';
require 'src/Infrastructure/ProductRepositoryInMemory.php';
require 'src/Presentation/ProductController.php';


use App\Domain\Product;
use App\Application\GetProductsUseCase;
use App\Infrastructure\ProductRepositoryInMemory;
use App\Presentation\ProductController;

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestPath = $_SERVER['REQUEST_URI'];
$isDefaultResposneActive = true;

// Dependencias de la infraestructura
$domainProduct = new Product();

// Dependencias de la infraestructura
$productRepository = new ProductRepositoryInMemory();

// Dependencias de la aplicación
$getProductsUseCase = new GetProductsUseCase($productRepository);

// Controlador para listar productos
$productController = new ProductController($getProductsUseCase);

// Endpoint para listar productos
if ($requestMethod === 'GET' && $requestPath === '/productos') {
    $isDefaultResposneActive = false;
    $response = $productController->getProducts();
    echo json_encode($response);
}

// Endpoint para crear productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/add') {
    $isDefaultResposneActive = false;

    // Obtener los datos del producto desde el cuerpo de la petición
    $data = json_decode(file_get_contents('php://input'), true);

    // Respuesta con éxito
    $response = $productController->setProduct($data);

    http_response_code($response["code"]);
    echo json_encode($response);
}

if ($isDefaultResposneActive) {
    http_response_code(400);
    echo json_encode(array('message' => 'Error: Please check your request'));
}
