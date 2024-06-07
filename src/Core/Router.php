<?php

namespace App\Core;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

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
      $path = rtrim($path, '/') ?: '/';

      $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) {
        foreach ($this->routes as $route) {
          $routeCollector->addRoute($route['method'], $route['path'], $route['handler']);
        }
      });

      $routeInfo = $dispatcher->dispatch($method, $path);

      switch ($routeInfo[0]) {
        case \FastRoute\Dispatcher::NOT_FOUND:
          http_response_code(404);
          echo "404 Not Found";
          break;
        case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
          http_response_code(405);
          echo "405 Method Not Allowed";
          break;
        case \FastRoute\Dispatcher::FOUND:
          $handler = $routeInfo[1];
          $vars = $routeInfo[2];

          if (is_array($handler)) {
            list($controller, $method) = $handler;
            $controllerInstance = new $controller();

            return call_user_func_array([$controllerInstance, $method], $vars);
          } else {
            return call_user_func_array($handler, $vars);
          }
        }
    }

    private function add($method, $path, $handler)
    {
        $path = ($this->groupPrefix ?? '') . $path;
        $this->routes[] = compact('method', 'path', 'handler');
    }
}

