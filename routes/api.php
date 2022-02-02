<?php

use Services\Support\ApiRoute as Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

$routes = Route::createCollection();

Route::get($routes, 'builder', '', [ProductController::class, 'summary_builder']);
Route::get($routes, 'raw', '/raw', [ProductController::class, 'summary_raw']);
Route::post($routes, 'product', '/getProduct', [ProductController::class, 'post']);

