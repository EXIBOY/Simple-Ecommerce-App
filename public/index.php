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

$router->addRoute('GET', '/admin/products/edit/:id', function ($id) use ($twig) {
    $controller = new AdminController();
    $controller->editView($twig, $id);
});

$router->addRoute('POST', '/admin/products/delete/', function () {
    $controller = new ProductsController();
    $controller->delete($_POST);
});

$router->addRoute('GET', '/products', function () use ($twig) {
    $controller = new ProductsController();
    $controller->view($twig);
});

// Handle the current request
$router->handleRequest();
