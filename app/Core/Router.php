<?php

namespace App\Core;

class Router {
    protected $routes = [];

    public function get($uri, $controller) {
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller) {
        $this->add('POST', $uri, $controller);
    }

    private function add($method, $uri, $controller) {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        
        // Handle sub-directory installation: /GameDeals/public/
        // Remove /GameDeals/public prefix from URI
        $basePath = '/GameDeals/public';
        
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        
        // Also handle if index.php is in the URI
        if (strpos($uri, '/index.php') === 0) {
            $uri = substr($uri, strlen('/index.php'));
        }
        
        // Ensure URI starts with / and handle empty case
        $uri = '/' . ltrim($uri, '/');
        if ($uri === '/') {
            $uri = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] == $method) {
                $parts = explode('@', $route['controller']);
                $controllerName = "App\\Controllers\\" . $parts[0];
                $action = $parts[1];
                
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $action)) {
                        $controller->$action();
                        return;
                    }
                }
            }
        }
        
        echo "404 Not Found - URI: " . $uri;
    }
}
