<?php

namespace App;

class Router
{
    private array $routes = [];

    // Register a route
    public function addRoute($method, $uri, $callback): void
    {
        // Normalize the URI by removing trailing slashes and ensuring a single trailing slash
        $uri = $this->normalizeUri($uri);
        $this->routes[] = ['method' => $method, 'uri' => $uri, 'callback' => $callback];
    }

    // Normalize the URI: remove leading slashes and ensure a single trailing slash
    private function normalizeUri($uri): string
    {
        // Remove leading slashes
        $uri = ltrim($uri, '/');

        // Ensure there's a trailing slash
        if (substr($uri, -1) !== '/') {
            $uri .= '/';
        }

        return $uri;
    }

    // Match the current request
    public function handleRequest()
    {
        // Get the request URI and strip any query string (i.e., everything after '?')
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = $this->normalizeUri($uri);

        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            // Compare normalized URI with the registered route
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
