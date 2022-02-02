<?php

use Services\Support\WebRoute as Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

$routes = Route::createCollection();

Route::get($routes, 'home', '/', [PageController::class, 'renderHome']);
Route::get($routes, 'product', '/product/{id}', [PageController::class, 'renderProduct'], array('id' => '[0-9]+'));