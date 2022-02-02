<?php

namespace Services\Support;

use Symfony\Component\Routing\Route as SymfonyRoute;
use Symfony\Component\Routing\RouteCollection;

class ApiRoute {
    public static function get(RouteCollection $routes, $name, $path, $controller, $params = []) {
        $routes->add($name, new SymfonyRoute(
            config('APP_URL_SUBFOLDER').'/api'.$path,
            array('controller' => $controller[0], 'method' => $controller[1]),
            $params
        ));
        $routes->get($name)->SetMethods('GET');
    }

    public static function post(RouteCollection $routes, $name, $path, $controller) {
        $routes->add($name, new SymfonyRoute(
            config('APP_URL_SUBFOLDER').'/api'.$path,
            array('controller' => $controller[0], 'method' => $controller[1])
        ));
        $routes->get($name)->setMethods('POST');
    }

    public static function createCollection() {
        return new RouteCollection();
    }
}