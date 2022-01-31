<?php

namespace App\Controllers;

use App\Models\Product;
use Symfony\Component\Routing\RouteCollection;

class PageController {

	public function render(RouteCollection $routes) {
        require_once APP_ROOT . '/resources/views/home.php';
	}
}