<?php
namespace Core;

class Router {
    private static $instance = null;
    private $routes = [];

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    public function addRoute($method, $uri, $controller, $action) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => rtrim($uri, '/'),
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function resolve() {
        $requestUri = str_replace('/mvc/public', '', rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
        foreach ($this->routes as $route) {
            if (preg_match("#^{$route['uri']}$#", $requestUri) && $route['method'] === $requestMethod) {
                if (!class_exists($route['controller']) || !method_exists($route['controller'], $route['action'])) {
                    echo "Error: Controller or action not found.";
                    return;
                }
                $controller = new $route['controller'];
                return $controller->{$route['action']}($_REQUEST);
            }
        }

        echo "404 Not Found";
    }

    private function __clone() {}

    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}
?>
