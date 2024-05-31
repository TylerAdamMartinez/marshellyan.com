<?php

namespace App\Facade;

use App\Core\Router;
use App\Core\Request;

class Route
{

    protected static $routerInstance;

    public static function getRouterInstance()
    {
        if (!self::$routerInstance) {
            self::$routerInstance = new Router();
        }
        return self::$routerInstance;
    }

    public static function __callStatic($method, $args)
    {
        $router = self::getRouterInstance();
        return call_user_func_array([$router, $method], $args);
    }

    public static function launch()
    {
        $request = new Request();
        $router = self::getRouterInstance();
        $router->dispatch($request->getMethod(), $request->getPath());
    }
}

