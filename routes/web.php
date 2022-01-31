<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for application.
|
*/

$routes = new RouteCollection();

$routes->add('product', new Route(
    constant('URL_SUBFOLDER') . '/product/{id}', array('controller' => 'ProductController', 'method'=>'showAction'), array('id' => '[0-9]+')));

$routes->add('home', new Route(
    constant('URL_SUBFOLDER').'/',
    array('controller' => 'PageController', 'method' => 'render')
));

