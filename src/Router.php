<?php

namespace App;

class Router
{
    private array $routes = [];

    // Register a route
    public function addRoute($method, $uri, $callback): void
    {
        $this->routes[] = ['method' => $method, 'uri' => $uri, 'callback' => $callback];
    }

    // Match the current request
    public function handleRequest()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($method == $route['method'] && $uri == $route['uri']) {
                // Call the controller action
                return call_user_func($route['callback']);
            }
        }

        // If no route is matched
        http_response_code(404);
        echo "Page not found!";
    }
}
