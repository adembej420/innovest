<?php
class Router {
    private $routes = [];
    
    /**
     * Register a route
     * 
     * @param string $page Route name
     * @param callable $callback Function to call when this route is matched
     */
    public function register($page, $callback) {
        $this->routes[$page] = $callback;
    }
    
    /**
     * Dispatch the request to the appropriate route handler
     * 
     * @param string $page Route name to dispatch
     * @return mixed Result of the route handler
     */
    public function dispatch($page) {
        if (isset($this->routes[$page])) {
            return call_user_func($this->routes[$page]);
        } else {
            // Default route or 404
            header("HTTP/1.0 404 Not Found");
            echo "Page not found";
            exit;
        }
    }
}
?>