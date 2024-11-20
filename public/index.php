<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Controller\HomeController;
use App\Controller\AdminController;
use App\Controller\ProductsController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Initialize Twig
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader, ['cache' => false]);

// Create a new router
$router = new Router();

// Add routes
$router->addRoute('GET', '/', function () use ($twig) {
    $controller = new HomeController();
    $controller->index($twig);
});

$router->addRoute('GET', '/admin', function () use ($twig) {
    $controller = new AdminController();
    $controller->index($twig);
});

$router->addRoute('POST', '/admin/products', function () {
    $controller = new ProductsController();
    $controller->create($_POST);
});

// Handle the current request
$router->handleRequest();
