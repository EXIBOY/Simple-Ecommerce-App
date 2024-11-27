<?php

namespace App\Controller;

use App\Model\ProductsModel;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class AdminController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index(Environment $twig): void
    {
        $productsModel = new ProductsModel();
        $products = $productsModel->getAllProducts();
        $products = array_map(function ($product) {
            $product['size'] = ucwords($product['size']);
            $product['name'] = ucwords($product['name']);

            return $product;
        }, $products);

        echo $twig->render('admin.twig', ['products' => $products]);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function editView(Environment $twig, int $id): void
    {
        $productsModel = new ProductsModel();
        $product = $productsModel->find($id);

        echo $twig->render('edit-products.twig', ['product' => $product]);
    }
}
