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

    public function findProducts(string $query): array
    {
        $sql = "SELECT * FROM products WHERE name LIKE '%" . $_GET['query'] . "%' OR size LIKE '%" . $_GET['query'] . "%'";
        $result = $this->databaseConnection->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find(int $id)
    {
        $sql = "SELECT * FROM products WHERE id = " . $id;
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM products WHERE id=$id";

        if ($this->databaseConnection->query($sql)) {
            return true;
        }

        return false;
    }

    public function create(array $data): bool
    {
        $productName = htmlspecialchars($data['name']);
        $productPrice = htmlspecialchars($data['price']);
        $productQuantity = htmlspecialchars($data['quantity']);
        $productSize = htmlspecialchars($data['size']);

        $sql = "INSERT INTO products (name, price, quantity, size, pictures) VALUES ('$productName', $productPrice, $productQuantity, '$productSize', '')";

        if ($this->databaseConnection->query($sql)) {
            return true;
        }

        return false;
    }
}
