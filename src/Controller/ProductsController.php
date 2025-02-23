<?php

namespace App\Controller;

use App\Model\ProductsModel;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ProductsController
{
    public function create(array $data): void
    {
        $model = new ProductsModel();

        // Define a target directory for file uploads
        $targetDir = "uploads/"; // Make sure this directory exists and is writable
        $uploadOk = 1; // Flag to check if everything is okay
        $fileName = ""; // To store the final file name
        $targetFile = ""; // Complete path to store the uploaded file
        $imageFileType = ""; // File extension (e.g., jpeg, png)
        $newFileName = "";

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $fileName = $_FILES["image"]["name"]; // Original file name
            $targetFile = $targetDir . basename($fileName);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // Get file extension

            // Check file size (e.g., limit to 10MB)
            if ($_FILES["image"]["size"] > 10000000) {
                echo "Sorry, your file is too large. Max size is 10MB.";
                $uploadOk = 0;
            }

            // Check if the file is an allowed type (e.g., images)
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
            if (!in_array($imageFileType, $allowedTypes)) {
                echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
                $uploadOk = 0;
            }

            var_dump("Here");

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                // Generate a unique file name to avoid overwriting existing files
                $newFileName = uniqid('file_', true) . '.' . $imageFileType;
                $targetFile = $targetDir . $newFileName;

                // Attempt to move the uploaded file to the target directory
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    echo "The file " . htmlspecialchars($newFileName) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        $data['pictures'] = $newFileName;

        if ($model->create($data)) {
            header('Location: /admin');
        }
    }

    public function update(array $data): void
    {
        $model = new ProductsModel();
        $productName = $data['productName'];
        $productPrice = $data['price'];
        $productQuantity = $data['quantity'];
        $productSize = $data['size'];
        $productImage = $data['image'];
        $productId = $data['id'];

        $sql = "UPDATE products SET name = '$productName', price = '$productPrice', quantity = '$productQuantity', size = '$productSize' WHERE id = '" . $productId . "'";

        if ($model->query($sql) === TRUE) {
            header('Location: /admin');
        }
    }

    public function delete(array $data): void
    {
        $model = new ProductsModel();

        if ($model->delete($data['id'])) {
            header('Location: /admin');
        }
    }

    public function filter(array $data): void
    {
        // Start with the basic SQL query to select all products
        $sql = "SELECT * FROM products WHERE 1";
        $model = new ProductsModel();

        // Initialize an array to hold the query conditions
        $conditions = [];

        // Check if 'query' is provided and not empty
        if (isset($data['query']) && !empty($data['query'])) {
            // Add a condition for the product name to use LIKE for partial matches
            $conditions[] = "name LIKE '%" .$data['query'] . "%'";
        }

        // Check if 'size' is provided and not empty
        if (isset($data['size']) && !empty($data['size'])) {
            // Add a condition to filter by size
            $conditions[] = "size = '" . $data['size'] . "'";
        }

        // Check if 'priceRange' is provided and not empty
        if (isset($data['priceRange']) && !empty($data['priceRange'])) {
            // Assuming priceRange is in the format 'min-max', e.g., '50-200'
            list($minPrice, $maxPrice) = explode('-', $data['priceRange']);
            // Add a condition to filter by price range
            $conditions[] = "price BETWEEN " . (int)$minPrice . " AND " . (int)$maxPrice;
        }

        // If there are any conditions, append them to the SQL query
        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }

        // Execute the query
        $result = $model->query($sql);
        $products = [];

        // Check if query was successful and process the results
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Process each product row as needed
                $products[] = $row;
            }
        }

        echo json_encode($products);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function view(Environment $twig, string $query = null): void
    {
        $productsModel = new ProductsModel();

        if (is_array($_GET) && count($_GET) > 0 && isset($_GET['query'])) {
            $query = $_GET['query'];
            $products = $productsModel->findProducts($query);
        } else {
            $products = $productsModel->getAllProducts();
        }

        $products = array_map(function ($product) {
            $product['size'] = ucwords($product['size']);
            $product['name'] = ucwords($product['name']);

            return $product;
        }, $products);

        echo $twig->render('products.twig', ['products' => $products]);
    }
}
