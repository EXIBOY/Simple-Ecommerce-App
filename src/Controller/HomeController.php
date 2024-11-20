<?php

namespace App\Controller;

use App\Model\ProductsModel;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController
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

        echo $twig->render('products.twig', ['products' => $products]);
    }
}
