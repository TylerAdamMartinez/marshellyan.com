<?php

namespace App\Core;

class Router
{
    private $routes = [];
    private $groupPrefix;

    public function get($path, $handler)
    {
        $this->add('GET', $path, $handler);
    }

    public function post($path, $handler)
    {

        $this->add('POST', $path, $handler);
    }

    public function put($path, $handler)
    {
        $this->add('PUT', $path, $handler);
    }

    public function patch($path, $handler)
    {
        $this->add('PATCH', $path, $handler);
    }

    public function delete($path, $handler)
    {
        $this->add('DELETE', $path, $handler);
    }

    public function group($prefix, $callback)
    {
        $this->groupPrefix = $prefix;
        $callback($this);
        $this->groupPrefix = null;
    }

    public function dispatch($method, $path)
    {
        foreach ($this->routes as $route) {
            $pattern = $this->convertToRegex($route['path']);
            if ($route['method'] === $method && preg_match($pattern, $path, $matches)) {
                array_shift($matches); // Remove the full match from the results

                if (is_array($route['handler'])) {
                    list($controller, $method) = $route['handler'];
                    $controllerInstance = new $controller();

                    return call_user_func_array([$controllerInstance, $method], $matches);
                } else {
                    return call_user_func_array($route['handler'], $matches);
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    private function add($method, $path, $handler)
    {
        $path = ($this->groupPrefix ?? '') . $path;
        $this->routes[] = compact('method', 'path', 'handler');
    }

    private function convertToRegex($path)
    {
        $path = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_-]+)', $path);
        return "#^{$path}$#";
    }
}
