<?php

class Router
{
    private $routes = [];

    public function addRoute($url, $callback)
    {
        $this->routes[$url] = $callback;
    }

    public function dispatch()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = $this->removeQueryString($uri);

        if (array_key_exists($uri, $this->routes)) {
            $callback = $this->routes[$uri];
            if (is_callable($callback)) {
                call_user_func($callback);
                return;
            }
            if (is_array($callback) && count($callback) === 2) {
              $controller = new $callback[0]();
              $action = $callback[1];
              if (method_exists($controller, $action)) {
                $controller->$action();
                return;
              }
            }
        }

        http_response_code(404);
        echo "Página não encontrada";
    }

    private function removeQueryString($url) {
        $pos = strpos($url, '?');
        if ($pos !== false) {
            return substr($url, 0, $pos);
        }
        return $url;
    }

    public function routes()
    {
        return $this->routes;
    }
}