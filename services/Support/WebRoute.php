<?php

namespace Services\Support;

use Symfony\Component\Routing\Route as SymfonyRoute;
use Symfony\Component\Routing\RouteCollection;

class WebRoute {
    public static function get(RouteCollection $routes, $name, $path, $controller, $params = []) {
        $routes->add($name, new SymfonyRoute(
            config('APP_URL_SUBFOLDER').$path,
            array('controller' => $controller[0], 'method' => $controller[1]),
            $params
        ));
    }

    public static function createCollection() {
        return new RouteCollection();
    }
}