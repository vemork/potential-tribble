<?php

namespace App\Infrastructure;

interface DatabasePort {
    public function setNewProduct(array $data);
    public function read($id);
    public function update($id, array $data);
    public function delete($id);
    public function getAll();
    // Otros métodos necesarios...
}
?>