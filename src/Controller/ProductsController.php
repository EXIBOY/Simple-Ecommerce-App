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

        if ($model->create($data)) {
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
