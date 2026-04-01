<?php
class Router {
    private $routes = [];

    // Register a GET route
    public function get($path, $controller, $action) {
        $this->add('GET', $path, $controller, $action);
    }

    // Register a POST route
    public function post($path, $controller, $action) {
        $this->add('POST', $path, $controller, $action);
    }
    
    // Register a route for multiple methods
    public function any($path, $controller, $action) {
        $this->add('ANY', $path, $controller, $action);
    }

    private function add($method, $path, $controller, $action) {
        // Convert route parameters like {id} or {slug} into regex capture groups
        // e.g., /article/show/{id} -> /article/show/([^/]+)
        $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $path);
        
        // Ensure exact matching of the path
        $routeRegex = '#^' . $routeRegex . '$#';

        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'regex' => $routeRegex,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch($uri, $requestMethod) {
        // Parse the requested URI path
        $parsedUrl = parse_url($uri);
        $path = $parsedUrl['path'] ?? '/';
        
        // Strip out the base folder if the script is running in a subdirectory
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptName !== '/' && $scriptName !== '\\') {
            $path = preg_replace('#^' . preg_quote($scriptName, '#') . '#', '', $path);
        }
        
        if (empty($path)) {
            $path = '/';
        }

        // Find the matching route
        foreach ($this->routes as $route) {
            // Check method match
            if ($route['method'] === 'ANY' || $route['method'] === $requestMethod) {
                // Check path match with regex
                if (preg_match($route['regex'], $path, $matches)) {
                    array_shift($matches); // Remove the full path match from array
                    
                    $controllerName = $route['controller'];
                    $actionName = $route['action'];
                    
                    if (file_exists('controllers/' . $controllerName . '.php')) {
                        require_once 'controllers/' . $controllerName . '.php';
                        $controller = new $controllerName();
                        
                        if (method_exists($controller, $actionName)) {
                            // Call the controller action, passing captured regex values as parameters
                            call_user_func_array([$controller, $actionName], $matches);
                            return;
                        }
                    }
                }
            }
        }
        
        // If no route matches, trigger a 404
        http_response_code(404);
        echo "<h1 style='text-align:center;font-family:sans-serif;margin-top:50px;color:#333;'>404 - Page Not Found</h1>";
        echo "<p style='text-align:center;font-family:sans-serif;'><a href='" . BASE_URL . "'>Return Home</a></p>";
    }
}
