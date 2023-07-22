<?php

namespace App\Infrastructure;

require 'src/Infrastructure/DatabasePort.php';

class ProductRepositoryAdapter implements DatabasePort
{
    private $connection;
    private $products;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function setNewProduct(array $data)
    {

        $name = $data['name'];
        $reference = $data['reference'];
        $price = $data['price'];
        $weight = $data['weight'];
        $category = $data['category'];
        $stock = $data['stock'];
        $date = $data['date'];


        $nuevoProductoJSON = [
            'name' => $data['name'],
            'reference' => $data['reference'],
            'price' => $data['price'],
            'weight' => $data['weight'],
            'category' => $data['category'],
            'stock' => $data['stock'],
            'date' => $data['date'],
        ];
        $this->connection->conectar();
        $sql = "INSERT INTO products (name, reference, price, weight, category, stock, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepareStatement($sql);
        $stmt->bind_param("ssdssis", $name, $reference, $price, $weight, $category, $stock, $date);

        // Ejecutar la query
        if ($stmt->execute()) {
            if ($this->connection->getAffectedRows() > 0) {
                return (array(
                    'message' => 'Producto actualizado correctamente.',
                    'err' => false,
                    'code' => 200,
                    'data' => $nuevoProductoJSON,
                ));
            }
            $stmt->close();
        } else {
            return (array(
                'message' => 'Error al actualiazr el producto:',
                'err' => true,
                'code' => 500,
                'data' => $this->connection->error,
            ));
        }
        $this->connection->desconectar();
    }

    public function read($id)
    {
        // Implementación de la operación de lectura utilizando mysqli o PDO
    }

    public function update($id, array $data)
    {
        // Implementación de la operación de actualización utilizando mysqli o PDO
    }

    public function delete($id)
    {
        // Query para eliminar el producto
        $query = "DELETE FROM products WHERE idproducts = $id";

        $this->connection->conectar();
        // Ejecutar la query
        if ($this->connection->ejecutar($query) === TRUE) {
            if ($this->connection->getAffectedRows() > 0) {
                return (array(
                    'message' => 'Producto eliminado correctamente.',
                    'err' => false,
                    'code' => 200,
                    'data' => [],
                ));
            } else {
                return (array(
                    'message' => 'El ID proporcionado no existe',
                    'err' => true,
                    'code' => 400,
                    'data' => $id,
                ));
            }
        } else {
            return (array(
                'message' => 'Error al eliminar el producto:',
                'err' => true,
                'code' => 500,
                'data' => $this->connection->error,
            ));
        }
        $this->connection->desconectar();
    }

    public function getAll()
    {


        $query = "SELECT * FROM products";
        $this->connection->conectar();
        $resultado = $this->connection->ejecutar($query);
        $this->connection->desconectar();

        $productos_encontrados = array();
        while ($fila = $resultado->fetch_assoc()) {
            $productos_encontrados[] = $fila;
        }

        return $productos_encontrados;
    }
}
