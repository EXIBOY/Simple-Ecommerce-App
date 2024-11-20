<?php

namespace App\Model;

class ProductsModel extends Model
{
    public function getAllProducts(): array
    {
        $sql = "SELECT * FROM products";
        $result = $this->databaseConnection->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
