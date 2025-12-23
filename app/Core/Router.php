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
        
        // Handle sub-directory installation
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        // Normalize slashes
        $scriptName = str_replace('\\', '/', $scriptName);
        
        // Remove script path from URI
        if (strpos($uri, $scriptName) === 0) {
            $uri = substr($uri, strlen($scriptName));
        }
        
        // Ensure URI starts with /
        $uri = '/' . ltrim($uri, '/');

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
